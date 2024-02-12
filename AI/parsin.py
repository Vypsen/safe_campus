import vk_api
import requests
import time
import pandas as pd
import psycopg2
from psycopg2 import sql
from contextlib import closing
from datetime import datetime
from tqdm import tqdm
from flask import Flask, request, jsonify
from flask_cors import CORS

import torch
from transformers import AutoTokenizer, AutoModelForSequenceClassification
app = Flask(__name__)
CORS(app)


def url_group_to_id(url, token):
    vk_session = vk_api.VkApi(token=token)
    vk = vk_session.get_api()
    response = vk.utils.resolveScreenName(screen_name=url.replace('https://vk.com/', ''))
    if len(response):
        group_id = response['object_id']
        return group_id
    else:
        return None




def get_users(group_id, token):
    good_id_list = []
    offset = 0
    while(True):
        response = requests.get('https://api.vk.com/method/groups.getMembers', params={
            'access_token':token,
            'v':5.103,
            'group_id': group_id,
            'sort':'id_desc',
            'offset':offset,
            'count':100,
            'fields':'last_seen'
        }).json()['response']
        offset += 100

        for item in response['items']:
            try:
                if item['last_seen']['time'] >= 1605571200:
                    good_id_list.append(item)
            except Exception as E:
                continue
        if (len(response['items'])  < 100):
            break
    return good_id_list


def get_all_users_from_group(group_list, token):
    all_users = []
    for group in list(group_list.keys()):
        try:
            users = get_users(group, token)
            all_users.extend(list(map(lambda x: [float(x['id']), group, group_list[group]],users)))
            time.sleep(1)
        except KeyError as E:
            print('error', group, E)
            continue
        # print(group, group_list[group], len(list(map(lambda x: [x['id'], group, group_list[group]],users))))
    return all_users # return list([id_user:int, 'school_name':string, 'ru_name':string],[id_user:int, 'school_name':string, 'ru_name':string],)

def pars_vk(count, DOMAIN, token):

    max_post = ''
    with closing(psycopg2.connect(dbname='secure_campus', user='gachi',
                            password='BilliIsLife12345', host='81.177.136.243')) as conn:
        with conn.cursor() as cursor:
            cursor.execute('SELECT max(post_id) FROM comments')
            for row in cursor:
                max_post = row[0]

    domain_id = url_group_to_id('https://vk.com/'+DOMAIN, token)
    df_comm = []
    resp = 0
    count_post = 100
    count_comm = 100
    for i in range(count):
        # print('iteration', i)
        response_post = requests.get('https://api.vk.com/method/wall.get',
        params={'access_token': token,
                'v': VERSION,
                'domain': DOMAIN,
                'count': count_post,
                'offset':resp,
                'filter': str('owner')})

        data_post = response_post.json()['response']['items']

        for post in tqdm(data_post):

            comments = requests.get('https://api.vk.com/method/wall.getComments',
                                params={'access_token': token,
                                        'v': VERSION,
                                        'owner_id':-domain_id,
                                        'post_id':post['id'],
                                        'count': count_comm,
                                        'offset':0}
                                        ).json()['response']['items']
            new_comment = list(map(lambda x: [x['id'], x['from_id'], x['text'], datetime.fromtimestamp(x['date'])], comments))
            good_comment = []
            for stroka in new_comment:
                # print(str(stroka[0]), max_post)
                if str(stroka[0]) == max_post:
                    df_comm += good_comment
                    return df_comm
                good_comment.append(stroka)
            try:
                df_comm.append([post['id'], post['signer_id'], post['text'],datetime.fromtimestamp(post['date'])])
            except:
                df_comm.append([post['id'], None, post['text'],datetime.fromtimestamp(post['date'])])
            df_comm += good_comment


        resp += 100

    return df_comm


def insert_to_server(df):
    result = [(val[0],val[1],val[2],val[3],val[4],val[5],val[6]) for val in
            df.loc[:,['user_id', 'comments', 'date', 'post_id', 'name', 'ru_name', 'source']].values.tolist()]
    with closing(psycopg2.connect(dbname='secure_campus', user='gachi',
                            password='BilliIsLife12345', host='81.177.136.243')) as conn:
        with conn.cursor() as cursor:
            conn.autocommit = True
            insert = sql.SQL('INSERT INTO public."comments"(user_id, "text", "date", post_id, school, ru_school, source) VALUES {}').format(
                sql.SQL(',').join(map(sql.Literal, result))
            )
            cursor.execute(insert)



class TextClassifier: #types = ['negative', 'emotion', 'toxicity']
    def __init__(self, type_name):
        checkpoints = {'negative':'cointegrated/rubert-tiny-sentiment-balanced',
                          'emotion':'cointegrated/rubert-tiny2-cedr-emotion-detection',
                          'toxicity':'cointegrated/rubert-tiny-toxicity'}
        labels = {'negative':('negative', 'neutral', 'positive'),
                          'emotion':("no_emotion", "joy", "sadness", "surprise", "fear", "anger"),
                          'toxicity':("non-toxic", "insult", "obscenity", "threat", "dangerous")}
        if type_name not in checkpoints:
            print('error!!!!')
        self.model_checkpoint = checkpoints[type_name]
        self.tokenizer = AutoTokenizer.from_pretrained(self.model_checkpoint)
        self.model = AutoModelForSequenceClassification.from_pretrained(self.model_checkpoint)
        if torch.cuda.is_available():
            self.model.cuda()
        self.labels = labels[type_name]

    def score(self, text, return_label=False):
        with torch.no_grad():
            inputs = self.tokenizer(text, return_tensors='pt', truncation=True, padding=True).to(self.model.device)
            proba = torch.sigmoid(self.model(**inputs).logits).cpu().numpy()[0]
        result = dict(zip(self.labels, proba))
        result = sorted(result.items(), key=lambda item: item[1], reverse=True)
        return result[0][0] if return_label else dict(result)



def fill_score_table(data):
    with closing(psycopg2.connect(dbname='secure_campus', user='gachi',
                            password='BilliIsLife12345', host='81.177.136.243')) as conn:
        with conn.cursor() as cursor:
            model_types = ['negative', 'emotion', 'toxicity']
            for model_type in model_types:
                model = TextClassifier(type_name=model_type)
                model_name = f'{model_type}_model'
                get_score_row = lambda comm_row: (comm_row[3], model.score(comm_row[1], return_label=True), comm_row[2], comm_row[4], model_name, comm_row[6])
                values = [get_score_row(item) for item in tqdm(data.values)]
                # for i in values:
                #     print(i)
                insert = sql.SQL('INSERT INTO score_table (post_id, "class", "date", school, model_name, "source") VALUES {}').format(
                    sql.SQL(',').join(map(sql.Literal, values)) #массив кортежей
                )
                cursor.execute(insert)
                conn.commit()

def join_and_parsing(token, DOMAIN, count_post):
    group_list =  {
    'schoolofmedicinefefu': 'Школа Медицины ДВФУ',
    'lawschool_fefu':'Юридическая школа ДВФУ',
    'iwo_dvfu':'Институт Мирового океана | ИМО ДВФУ',
    'polytech_dvfu':'Политехнический институт | ДВФУ',
    'pedagogdv':'Школа педагогики ДВФУ',
    'shem_dvfu':'Школа экономики и менеджмента ДВФУ',
    'sno_shrmi':'Студенческое научное общество ВИ-ШРМИ ДВФУ',
    'imct_fefu':'ИМКТ ДВФУ',
    'shign.dvfu':'Школа искусств и гуманитарных наук ДВФУ',
    'intpm_dvfu':'ИНТПМ ДВФУ',
    'pish_fefu':'ПИШ ДВФУ | Передовая инженерная школа ДВФУ'
    }
    VERSION = 5.103

    all_users_sort = pd.DataFrame(get_all_users_from_group(group_list, token), columns=['id', 'name', 'ru_name']).drop_duplicates('id')

    df = pars_vk(count_post, DOMAIN, token)
    df_comments = pd.DataFrame(df, columns=['post_id', 'user_id', 'comments', 'date'])
    df_comments['source'] = DOMAIN
    comments_result = df_comments.merge(all_users_sort, how='left', left_on='user_id', right_on='id')

    fill_score_table(comments_result.loc[:, ['user_id', 'comments', 'date', 'post_id', 'name', 'ru_name', 'source']])
    insert_to_server(comments_result)


# переменные
# переменные
token = ''
DOMAIN =  'overhearfefu'
count_post = 1

@app.route('/', methods=['POST'])
def index():
    if request.args.get('data'):
        DOMAIN = request.args.get('data')
    else: DOMAIN =  'overhearfefu'

    join_and_parsing(token, DOMAIN, count_post)


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, threaded=True)



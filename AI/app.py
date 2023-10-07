from flask import Flask, request, jsonify
import numpy as np
from flask_cors import CORS
# from torchvision import transforms, models
# import torch
from PIL import Image
import os.path
import json
import base64
import io
import pandas as pd
import tensorflow as tf
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing.image import load_img
from tensorflow.keras.preprocessing.image import ImageDataGenerator
from skimage import transform
import tensorflow.keras.utils as image
from tensorflow.keras.preprocessing.image import img_to_array
from sklearn.cluster import KMeans
import requests
app = Flask(__name__)
CORS(app)


@app.route('/', methods=['GET'])
def index():
    return 'hello'

@app.route('/image/prediction', methods=['POST'])
def getPrediction():
    pass

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, threaded=True)

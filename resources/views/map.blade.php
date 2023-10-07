@extends('app')

@section('content')

    <div class="map h-100" style="background-image: url('storage/Background.jpg');">
        <button style="background-color: #5656b2" class="btn btn-primary m-3 fs-5 border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseSearch" aria-expanded="false"
                aria-controls="collapseSearch">
            Поиск
        </button>
        <div class="ms-3 collapse" id="collapseSearch">
            <div class="card card-body">
                <form class="">
                    <div class="d-flex">
                        <div class="col-xl-5 pe-4 mt-4">
                            <input class="form-control" placeholder="Ключевое слово">
                        </div>
                        <div class="col-xl-3 pe-3">
                            <label class="ms-1"> От </label>
                            <input type="date" class="col-xl-5 form-control">
                        </div>
                        <div class="col-xl-3 pe-3">
                            <label class="ms-1"> До </label>
                            <input type="date" class="col-xl-5 form-control">
                        </div>
                        <div class="col-xl-1 mt-4">
                            <button type="submit" class="btn btn-success form-control">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex mt-4 ">
                        <div class="classes col-xl-7">
                        <h5 class="mb-3"> Классификация </h5>
                        <div class="d-flex">
                            <div class="col-xl-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="model" value="negative_model"
                                           id="negative_model" checked>
                                    <label class="form-check-label fw-medium" for="negative_model">
                                        По настроению
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="model" value="emotions_model"
                                           id="emotions_model">
                                    <label class="form-check-label fw-medium" for="emotions_model">
                                        По эмоциям
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="model" value="toxicity_model"
                                           id="toxicity_model">
                                    <label class="form-check-label fw-medium" for="toxicity_model">
                                        По токсичности
                                    </label>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="d-none negative_model">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="class"
                                               value="negative"
                                               id="negative"
                                               checked
                                        >
                                        <label class="form-check-label" for="negative">
                                            Негативные
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="class"
                                               value="neutral"
                                               id="neutral">
                                        <label class="form-check-label" for="neutral">
                                            Нейтральные
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="class"
                                               value="positive"
                                               id="positive">
                                        <label class="form-check-label" for="positive">
                                            Позитивные
                                        </label>
                                    </div>
                                </div>
                                <div class="d-none emotions_model">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="class"
                                               value="no_emotion"
                                               id="no_emotion">
                                        <label class="form-check-label" for="no_emotion">
                                            Безэмоциально
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="class"
                                               value="sadness"
                                               id="sadness">
                                        <label class="form-check-label" for="sadness">
                                            Грустно
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="class"
                                               value="surprise"
                                               id="surprise">
                                        <label class="form-check-label" for="surprise">
                                            Удивленно
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="class"
                                               value="anger"
                                               id="anger">
                                        <label class="form-check-label" for="anger">
                                            Гневно
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="class"
                                               value="fear"
                                               id="fear">
                                        <label class="form-check-label" for="fear">
                                            Страшно
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="class"
                                               value="joy"
                                               id="joy">
                                        <label class="form-check-label" for="joy">
                                            Радостно
                                        </label>
                                    </div>
                                </div>
                                <div class="d-none toxicity_model">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="class"
                                               value="non-toxic"
                                               id="non-toxic">
                                        <label class="form-check-label" for="non-toxic">
                                            Без токсичности
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="class"
                                               value="dangerous"
                                               id="dangerous">
                                        <label class="form-check-label" for="dangerous">
                                            Опасность
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="class"
                                               value="insult"
                                               id="insult">
                                        <label class="form-check-label" for="insult">
                                            Оскорбление
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="class"
                                               value="threat"
                                               id="threat">
                                        <label class="form-check-label" for="threat">
                                            Угрожающе
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="class"
                                               value="obscenity"
                                               id="obscenity">
                                        <label class="form-check-label" for="obscenity">
                                            Непристойность
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-xl-5">
                            <h5 class="mb-3"> Источник </h5>
                            <select name="source" class="form-select">
                                @foreach($sources as $source)
                                    <option value="{{$source}}" selected> https://vk.com/{{$source}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <button style="background-color: #5656b2" class="float-end btn btn-primary m-3 fs-5 border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseSet" aria-expanded="false"
                aria-controls="collapseSet">
            Добавить в датасет
        </button>

        <div class="ms-3 col-xl-5 collapse" id="collapseSet">
            <div class="card card-body">
                <form class="">
                    <input type="text" class="form-control" name="token_vk" id="" placeholder="Токен ВК">
                    <div class="d-flex">
                        <input type="text" class="form-control col-xl-12" name="source" id=""
                               placeholder="Ссылка на сообщество">
                        <button type="submit" class="col-xl-1 btn btn-success form-control">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @for ($i = 0; $i < 11; $i++)
        <div class="school position-absolute" style="">
            <div class="d-flex school_btn justify-content-center align-content-center">
                <img class="my-auto py-2" src="" alt="">
            </div>
            <span class="caption_school d-flex mt-1 text-center mx-auto fw-bold fs-4" style=""></span>
        </div>
    @endfor


    <script>
        $(document).ready(function () {
            corpuses = ['AES', 'IMCT', 'PI', 'IHTAM', 'TOISRIS', 'IWO', 'SMLS', 'SEM', 'SL', 'SAH', 'SE'];
            corpuses_ru = {
                'AES': ['ПИШ'],
                'IMCT': ['ИМКТ'],
                'PI': ["ПИ"],
                'IHTAM': ["ИНТИПМ"],
                'TOISRIS': ["ВИШРМИ"],
                'IWO': ["ИМО"],
                'SMLS': ["ШМ"],
                'SEM': ["ШЭМ"],
                'SL': ["ЮШ"],
                'SAH': ["ШИГН"],
                'SE': ["ШП"]
            };
            dots = {
                'AES': [1138, 270],
                'IMCT': [1336, 270],
                'PI': [446, 314],
                'IHTAM': [1659, 132],
                'TOISRIS': [1138, 470],
                'IWO': [1336, 470],
                'SMLS': [876, 85],
                'SEM': [1735, 414],
                'SL': [1552, 385],
                'SAH': [60, 452],
                'SE': [253, 374]
            }
            count = 0
            $('.school').each(function () {
                $(this).addClass(corpuses[count]);
                $(this).css('left', String(dots[corpuses[count]][0]) + 'px');
                $(this).css('top', String(dots[corpuses[count]][1]) + 'px');
                $(this).find('img').attr('src', 'storage/' + corpuses[count] + '.png');
                $(this).find('span').text(corpuses_ru[corpuses[count]][0]);
                count += 1
            })

            $(".school_btn").hover(function () {
                $(this).parent().find('.caption_school').first().css("opacity", 1);
                $(this).parent().find('.caption_school').first().css("transform", 'scale(1.1)');
            }, function () {
                $(this).parent().find('.caption_school').first().css("opacity", 0);
                $(this).parent().find('.caption_school').first().css("transform", 'scale(1.0)');
            });


            $('.classes input[name="model"]').on('click', function () {
                val =  $(this).val()
                $('.negative_model').addClass('d-none')
                $('.emotions_model').addClass('d-none')
                $('.toxicity_model').addClass('d-none')
                $('.'+val).removeClass('d-none')
            })

            $('.classes input[name="class"]').each(function () {
                $(this).next().addClass('fw-medium')
            });

            $('.classes input[name="model"]:checked').click();
        })
    </script>
@endsection

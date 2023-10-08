@extends('app')

@section('content')

    <div class="map h-100 d-block" style="background-image: url('storage/Background.jpg');">
        <div class="search position-absolute z-3 top-0 start-0 m-2" style="width: 55%">
            <button style="background-color: #5656b2" class="btn btn-primary m-3 fs-5 border-0" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseSearch" aria-expanded="false"
                    aria-controls="collapseSearch">
                Поиск
            </button>
            <div class="ms-3 collapse w-100" id="collapseSearch">
                <div class="card card-body">
                    <form class="">
                        <div class="d-flex">
                            <div class="col-xl-5 pe-4 mt-4">
                                <input name="keyword" class="form-control" placeholder="Ключевое слово">
                            </div>
                            <div class="col-xl-3 pe-3">
                                <label class="ms-1"> От </label>
                                <input type="date" name="from" class="col-xl-5 form-control">
                            </div>
                            <div class="col-xl-3 pe-3">
                                <label class="ms-1"> До </label>
                                <input type="date" name="to" class="col-xl-5 form-control">
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
                                            <input class="form-check-input" type="radio" name="model"
                                                   value="negative_model"
                                                   id="negative_model" checked>
                                            <label class="form-check-label fw-medium" for="negative_model">
                                                По настроению
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="model"
                                                   value="emotions_model"
                                                   id="emotions_model">
                                            <label class="form-check-label fw-medium" for="emotions_model">
                                                По эмоциям
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="model"
                                                   value="toxicity_model"
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
        </div>
        <div class="set-ds col-xl-5 position-absolute bottom-0 mb-3" style="">

            <button style="background-color: #5656b2" class=" btn btn-primary m-3 fs-5 border-0" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseSet" aria-expanded="false"
                    aria-controls="collapseSet">
                Добавить в датасет
            </button>

            <div class="ms-3 w-100 collapse float-start" id="collapseSet">
                <div class="card card-body">
                    <form id="parser" class="">
                        @csrf
                        <input type="text" class="form-control" name="token_vk" id="" placeholder="Токен ВК">
                        <div class="d-flex mt-2">
                            <div class="col-lg-10">
                                <input type="text" class="form-control col-xl-9" name="source" id="token"
                                       placeholder="Ссылка на сообщество">
                            </div>
                            <div class="col-lg-2 ps-3">
                                <button type="button" class="btn btn-success set-ds-btn form-control">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach($schools as $key => $school)

        <div id="{{$school}}" class="school z-2  position-absolute" style="">
            <div class="d-flex school_btn w-100 h-100 justify-content-center align-content-center">
                <img class="my-auto py-1" src="" alt="">
            </div>
            <span class="caption_school d-flex mt-xxl-1 text-center mx-auto fw-bold fs-4" style=""></span>
        </div>
        @if(isset($opacity[0]->share))
            <img src="" class="school_img_red z-1 position-absolute" style="opacity: {{$opacity[$key]->share}};">
            <img src="" class="school_img_yel z-1 position-absolute" style="opacity: {{1-$opacity[$key]->share}}">
        @endif
    @endforeach

    <div class="top-0 h-100 start-0 z-3 w-100 position-absolute school-info-block d-none" style="padding: 15px">
        <div class="card h-100">
            <div class="position-absolute top-0 end-0 m-3">
                <i class="fa-solid fa-xmark fs-3" style="cursor: pointer;"></i>
            </div>
            <div class="card-body school-graf">
                <h1 class="title_school"></h1>
                <div class="spinner-border " role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <canvas class="position-absolute start-0" id="pie-chart"
                        style="top:100px; max-width: 600px; max-height: 600px" width="800" height="450"></canvas>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            corpuses = ['IMCT', 'SE', 'IHTAM', 'PI', 'SAH', 'SEM', 'IWO', 'SMLS', 'TOISRIS', 'SL', 'AES'];
            corpuses_ru = {
                'IMCT': ['ИМКТ'],
                'SE': ["ШП"],
                'IHTAM': ["ИНТИПМ"],
                'PI': ["ПИ"],
                'SAH': ["ШИГН"],
                'SEM': ["ШЭМ"],
                'IWO': ["ИМО"],
                'SMLS': ["ШМ"],
                'TOISRIS': ["ВИШРМИ"],
                'SL': ["ЮШ"],
                'AES': ['ПИШ'],
            };
            dots = {
                'IMCT': [69.58, 25],
                'AES': [59.27, 25],
                'PI': [23.22, 29.07],
                'IHTAM': [86.4, 12.22],
                'TOISRIS': [59.27, 43.51],
                'IWO': [69.58, 43.51],
                'SMLS': [45.62, 7.87],
                'SEM': [90.36, 38.33],
                'SL': [80.83, 35.64],
                'SAH': [3.12, 41.85],
                'SE': [13.17, 34.62]
            }
            dots_img = {
                'AES': [60, 35.83],
                'IMCT': [67.91, 38.42],
                'PI': [17.6, 34.62],
                'IHTAM': [83.48, 12.77],
                'TOISRIS': [59.11, 44.25],
                'IWO': [65.57, 43.88],
                'SMLS': [44.01, 7.96],
                'SEM': [86.56, 36.38],
                'SL': [78.64, 33.05],
                'SAH': [2.47, 45.41],
                'SE': [10.1, 41.94]
            }
            count = 0

            $('.school').each(function () {
                $(this).addClass(corpuses[count]);
                $(this).css('left', String(dots[corpuses[count]][0]) + '%');
                $(this).css('top', String(dots[corpuses[count]][1]) + '%');
                $(this).find('img').attr('src', 'storage/' + corpuses[count] + '.png');
                $(this).find('span').text(corpuses_ru[corpuses[count]][0]);
                count += 1
            })

            count = 0

            $('.school_img_yel').each(function () {
                console.log(corpuses[count] + '_RED' + '.png')
                $(this).css('left', String(dots_img[corpuses[count]][0]) + '%');
                $(this).css('top', String(dots_img[corpuses[count]][1]) + '%');
                $(this).attr('src', 'storage/' + corpuses[count] + '_YEL' + '.png');
                $(this).prev().css('left', String(dots_img[corpuses[count]][0]) + '%');
                $(this).prev().css('top', String(dots_img[corpuses[count]][1]) + '%');
                $(this).prev().attr('src', 'storage/' + corpuses[count] + '_RED' + '.png');

                count += 1
            })

            $('.school').click(function () {
                $('.title_school').addClass('d-none')
                $('.spinner-border').removeClass('d-none')
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'getSchoolInfo',
                    method: "GET",
                    data: {school: $(this).attr('id')},
                    // cache: false,
                    // contentType: false,
                    // processData: false
                })
                    .done(function (data) {
                        $('.title_school').text(data[0]);
                        // $('.school-graf').load(location.href + ' .school-graf');
                        $('.title_school').removeClass('d-none');
                        $('.spinner-border').addClass('d-none')
                        $('.school-graf').removeClass('d-none');

                        const names = [];
                        const ages = [];

                        data = data[1]
                        console.log(data)

                        for (let i = 0; i < data.length; i++) {
                            const item = data[i];
                            console.log(item)
                            names.push(item.count_n);
                            ages.push(item.label);
                        }
                        console.log(names)
                        console.log(ages)
                        new Chart(document.getElementById("pie-chart"), {
                            type: 'pie',
                            data: {
                                labels: ages,
                                datasets: [{
                                    backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f"],
                                    data: names
                                }]
                            },
                        });
                    });
            });

            $(".school_btn").hover(function () {
                $(this).parent().find('.caption_school').first().css("opacity", 1);
                $(this).parent().find('.caption_school').first().css("transform", 'scale(1.1)');
            }, function () {
                $(this).parent().find('.caption_school').first().css("opacity", 0);
                $(this).parent().find('.caption_school').first().css("transform", 'scale(1.0)');
            });


            $('.classes input[name="model"]').on('click', function () {
                val = $(this).val()
                $('.negative_model').addClass('d-none')
                $('.emotions_model').addClass('d-none')
                $('.toxicity_model').addClass('d-none')
                $('.' + val).removeClass('d-none')
            })

            $('.classes input[name="class"]').each(function () {
                $(this).next().addClass('fw-medium')
            });

            $('.classes input[name="model"]:checked').click();

            $('.school_btn').click(function () {
                $('.school-info-block').removeClass('d-none');
            });

            $('.fa-xmark').click(function () {
                $('.title_school').text('');
                $('.school-info-block').addClass('d-none');
                new Chart(document.getElementById("pie-chart"), {
                    type: 'pie',
                    data: {},
                });
                // $('.school-graf').load(location.href + ' .school-graf');
            })

            $('.set-ds-btn').click(function () {
                data = $('.token').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'http://localhost:5000',
                    method: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                    .done(function (data) {
                       console.log(data)
                    });
            })
        })
    </script>
@endsection

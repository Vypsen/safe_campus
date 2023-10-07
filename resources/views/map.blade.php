@extends('app')

@section('content')

    <div class="map h-100" style="background-image: url('storage/Background.jpg');">
        <button style="background-color: #5656b2" class="btn btn-primary m-3 fs-5 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Поиск
        </button>
        <div class="ms-3 col-xl-4 collapse" id="collapseExample">
            <div class="card card-body">
                <form class="d-flex">
                    <div class="col-xl-6 pe-4">
                        <input class="form-control" placeholder="Ключевое слово">
                    </div>
                    <div class="col-xl-4 pe-3">
                        <input type="date" class="col-xl-5 form-control">
                    </div>
                    <div class="col-xl-2">
                        <button type="submit" class="btn btn-success form-control"> <i class="fa-solid fa-magnifying-glass"></i> </button>
                    </div>
                </form>
            </div>
        </div>

        @for ($i = 0; $i < 11; $i++)
            <div class="school position-absolute" style="">
                <div class="d-flex school_btn justify-content-center align-content-center"><img class="my-auto py-2" src="" alt=""></div>
                <span class="caption_school d-flex mt-1 text-center mx-auto fw-bold fs-4" style=""></span>
            </div>
        @endfor
    </div>


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
                'AES': [1128, 290],
                'IMCT': [1326, 290],
                'PI': [436, 334],
                'IHTAM': [1649, 162],
                'TOISRIS': [1128, 490],
                'IWO': [1326, 490],
                'SMLS': [866, 105],
                'SEM': [1725, 434],
                'SL': [1542, 405],
                'SAH': [50, 472],
                'SE': [243, 394]
            }
            count = 0
            $('.school').each(function () {
                $(this).addClass(corpuses[count]);
                $(this).css('left', String(dots[corpuses[count]][0] + 10) + 'px');
                $(this).css('top', String(dots[corpuses[count]][1] - 20) + 'px');
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
        })
    </script>
@endsection

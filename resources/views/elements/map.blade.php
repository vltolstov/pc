<div class="map">
    <div class="container">
        <div class="row map-wrap">
            <div class="col-lg-12">

                <div class="map-header">
                    <h3>География поставок и запусков</h3>
                </div>
                <div class="map-block">
                    <object class="map-svg" data="/images/map.svg" type="image/svg+xml"></object>
                </div>
                <div class="map-flex">
                    @foreach($projects as $project)
                        @if(isset($project->image))
                            <a href="{{$project->urn}}"
                                class="map-project"
                                data-id="{{$loop->iteration}}"
                                @foreach(json_decode($project->params, true) as $param)
                                    @if($param['name'] == 'город')
                                        data-city="{{Str::slug($param['value'], '-')}}"
                                    @endif
                                @endforeach
                                style="background-image: url('{{json_decode($project->image, true)['image-1']['200x150']}}')"
                            >
                                <p>{{$project->name}}</p>
                            </a>
                        @else
                            <img src="/images/default-200x150.png" alt=" ">
                        @endif

                    @endforeach

{{--                    <a href="#" class="map-project" data-id="1" data-city="bratsk" style="background-image: url('/images/default-800x600.png')">--}}
{{--                        <p>Текстовое поле для вывода длиного заголовка с переносом строки множеством букв</p>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="map-project" data-id="2" data-city="moskva" style="background-image: url('/images/default-800x600.png')">--}}
{{--                        <p>Запуск плавильной печи GWJ 0.45-300-1</p>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="map-project" data-id="3" data-city="novosibirsk" style="background-image: url('/images/default-800x600.png')">--}}
{{--                        <p>Поставка дробеметной установки проходного типа QB4948</p>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="map-project" data-id="4" data-city="perm" style="background-image: url('/images/default-800x600.png')">--}}
{{--                        <p>Текстовое поле для вывода заголовка</p>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="map-project" data-id="5" data-city="penza" style="background-image: url('/images/default-800x600.png')">--}}
{{--                        <p>Текстовое поле для вывода заголовка</p>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="map-project" data-id="6" data-city="tver" style="background-image: url('/images/default-800x600.png')">--}}
{{--                        <p>Текстовое поле для вывода заголовка</p>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="map-project" data-id="7" data-city="vladivostok" style="background-image: url('/images/default-800x600.png')">--}}
{{--                        <p>Текстовое поле для вывода заголовка</p>--}}
{{--                    </a>--}}
                </div>
            </div>
        </div>
    </div>
</div>

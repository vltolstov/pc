@extends('.layouts.main')

@section('content')

    <div class="web-page-block">
        <div class="container">
            <div class="row web-page-wrap">
                <div class="col-lg-12">
                    <div class="web-page-headers">
                        <h1>{{$title}}</h1>
                        @isset($params)
                            @foreach($params as $param)
                                @if($param['name'] == 'categoryMiniHeader')
                                    <p>{{$param['value']}}</p>
                                @endif
                            @endforeach
                        @endisset
                    </div>
                </div>
                <div class="col-lg-5">
                    @isset($introtext)
                        @foreach($introtext as $paragraph)
                            <p class="web-page-info">{{$paragraph}}</p>
                        @endforeach
                    @endisset
                    <div class="web-page-offer-button request-button" data-title="Запрос {{$title}}">
                        <p>Отправить запрос</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="web-page-image">
                                @if(isset($images))
                                    @foreach($images as $image)
                                        <a href="{{$image['1200x900']}}" class="glightbox">
                                            <img src="{{$image['800x600']}}" alt="{{$title}}">
                                        </a>
                                        @break
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @isset($content)
        @include('.elements.content')
    @endisset

    @include('.elements.consultation')

@endsection

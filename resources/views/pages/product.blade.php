@extends('.layouts.main')

@section('content')
    <div class="content-block">
        @include('.elements.breadcrumbs')
        <div class="content-header">
            <h1>{{$title}}</h1>
        </div>
    </div>
    <div class="row main-info-flex">
        <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
            @if(isset($images))
                @foreach($images as $image)
                    <div class="main-image">
                        <a href="{{$image['1200x900']}}" class="glightbox"><img src="{{$image['400x300']}}" alt="{{$title}}"></a>
                    </div>
                    @break
                @endforeach
            @else
                <div class="main-image">
                    <img src="/images/default-400x300.png" alt=" ">
                </div>
            @endif
        </div>
        <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12 info-column-flex">
            <div class="content-intro">
                <p>{{$introtext}}</p>
            </div>
            <div class="params-wrap">
                @foreach($params as $param)
                    @if($param['hide'] !== true)
                        <div class="row">
                            <div class="param-name col-lg-6 col-md-8 col-sm-6 col-xs-10">
                                {{$param['name']}}
                            </div>
                            <div class="param-value col-lg-6 col-md-4 col-sm-6 col-xs-2">
                                {{$param['value']}}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="request-button-wrap">
                <div class="request-button">
                    <p class="modal-form-button">Отправить запрос по цене и наличию</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        {!! $content !!}
    </div>
@endsection

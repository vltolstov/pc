@extends('layouts.main')

@section('content')

    @if(!isset($pages) || $pages->currentPage() <= 1)
        <div class="categories">
            <div class="container">
                <div class="row categories-wrap">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="category-headers">
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
                    <div class="col-lg-5 col-md-5 col-sm-5">
                        @isset($introtext)
                            @foreach($introtext as $paragraph)
                                <p class="category-info">{{$paragraph}}</p>
                            @endforeach
                        @endisset
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7">
                        <div class="row">
                            @empty($categories)
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="category-image">
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
                            @endempty
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @isset($content)
        @include('.elements.content')
    @endisset

    @isset($related_page_text)
        <div class="related-block">
            <div class="container">
                <div class="row related-block-wrap">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="related-block-headers">
                            <h3>Сопутствующее оборудование</h3>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                        <div class="related-block-headers">
                            <p>{{$related_page_name}}</p>
                        </div>
                        @foreach($related_page_text as $paragraph)
                            <p class="related-page-info">{{$paragraph}}</p>
                        @endforeach

                        <div class="related-block-button">
                            <a href="/{{$related_page_urn}}">Посмотреть</a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7">
                        <div class="related-page-image">
                            @if(isset($related_page_images))
                                @foreach($related_page_images as $image)
                                    <img src="{{$image['800x600']}}" alt="{{$related_page_name}}">
                                    @break
                                @endforeach
                            @else
                                <img src="/images/default-800x600.png" alt=" ">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    @include('.elements.about')
    @include('.elements.consultation')

@endsection

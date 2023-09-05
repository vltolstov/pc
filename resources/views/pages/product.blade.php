@extends('layouts.main')

@section('content')

    @if(!isset($pages) || $pages->currentPage() <= 1)
        <div class="categories">
            <div class="container">
                <div class="row categories-wrap">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="category-headers">
                            <h1>{{$title}}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        @isset($introtext)
                            @foreach($introtext as $paragraph)
                                <p class="category-info">{{$paragraph}}</p>
                            @endforeach
                        @endisset
                        <div class="product-param-table">
                            <table>
                                @isset($params)
                                    @foreach($params as $param)
                                        <tr>
                                            <td class="product-param-name">{{$param['name']}}</td>
                                            <td class="product-param-value">{{$param['value']}}</td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </table>
                        </div>
                        @isset($images)
                            <div class="gallery">
                                <div class="row">
                                    @foreach($images as $image)
                                        @if (!$loop->first)
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 gallery-item">
                                                <a href="{{$image['1200x900']}}" class="glightbox">
                                                    <img src="{{$image['200x150']}}" alt="{{$title}}">
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endisset
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="row">
                            @empty($categories)
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="category-offer-button request-button" data-title="Запрос {{$title}}">
                            <p>Отправить запрос</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @isset($solution_text)
        <div class="category-complete-solution">
            <div class="container">
                <div class="row complete-solution-wrap">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="solution-headers">
                            <h2>Комплексные решения</h2>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                        <div class="solution-headers">
                            <p>Под ключ</p>
                        </div>
                        @foreach($solution_text as $paragraph)
                            <p class="solution-info">{{$paragraph}}</p>
                        @endforeach
                        <div class="solution-button request-button" data-title="Запрос комплексного решения: {{$title}}">
                            <p>Запросить комплексное решение</p>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        <div class="solution-image">
                            <img src="{{ $solution_image }}" alt="{{$name}} - Комплексное решение">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    @isset($content)
        @include('.elements.content')
    @endisset

    @isset($related_page_text)
        <div class="related-block">
            <div class="container">
                <div class="row related-block-wrap">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="related-block-headers">
                            <h3>Сопутствующее оборудование</h3>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
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
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
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

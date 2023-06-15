@extends('layouts.main')

@section('content')

    <div class="categories">
        <div class="container">
            <div class="row categories-wrap">
                <div class="col-lg-12">
                    <div class="category-headers">
                        <h3>{{$title}}</h3>
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
                            <p class="category-info">{{$paragraph}}</p>
                        @endforeach
                    @endisset
                    <div class="category-offer-button request-button">
                        <p>Отправить запрос</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        @isset($categories)
                            @foreach($categories as $category)
                                <div class="col-lg-4">
                                    <div class="catalog-item">
                                        @if(isset($category->images))
                                            @foreach($category->images as $image)
                                                <a href="/{{$category->slug['urn']}}">
                                                    <div class="catalog-icon">
                                                        <img src="{{$image['200x150']}}">
                                                    </div>
                                                    <p>{{$category['name']}}</p>
                                                </a>
                                                @break
                                            @endforeach
                                        @else
                                            <a href="/{{$category->slug['urn']}}">
                                                <div class="catalog-icon">
                                                    <img src="/images/default-200x150.png">
                                                </div>
                                                <p>{{$category['name']}}</p>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                        @empty($categories)
                            <div class="col-lg-12">
                                <div class="category-image">
                                    @if(isset($images))
                                        @foreach($images as $image)
                                            <a href="{{$image['1200x900']}}" class="glightbox">
                                                <img src="{{$image['800x600']}}" alt="{{$title}}">
                                            </a>
                                            @break
                                        @endforeach
                                    @else
                                        <a href="/images/default-1200x900.png" class="glightbox">
                                            <img src="/images/default-800x600.png" alt=" ">
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>

    @isset($products)
    <div class="products-block">
        <div class="row">
            @foreach($products as $product)
                @if(isset($product->images))
                    @foreach($product->images as $image)
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a href="{{$product->slug['urn']}}" class="product-item" style="background-image: url('{{$image['200x150']}}')">
                                <p class="product-name">{{$product->seoSet['title']}}</p>
                                <p class="product-price mobile-off">Подробнее</p>
                            </a>
                        </div>
                        @break
                    @endforeach
                @else
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <a href="{{$product->slug['urn']}}" class="product-item" style="background-image: url('/images/default-200x150.png')">
                            <p class="product-name">{{$product->seoSet['title']}}</p>
                            <p class="product-price mobile-off">Подробнее</p>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    @endisset
    <div class="content">
        {!! $content !!}
    </div>
@endsection

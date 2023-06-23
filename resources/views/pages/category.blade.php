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
    <div class="products">
        <div class="container">
            <div class="row products-wrap products-wrap-close">
                @isset($products)
                    <table class="products-table">
                        <tr>
                            <th></th>
                            <th>Модель</th>
                            @foreach($products[0]->params as $param)
                                @if($param['active'] == true)
                                    <th class="param-name-cell">{{$param['name']}}</th>
                                @endif
                            @endforeach
                        </tr>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    @if(isset($product->images))
                                        <img src="{{$product['images']['image-1']['200x150']}}" alt="{{$name}}">
                                    @else
                                        <img src="/images/default-200x150.png" alt=" ">
                                    @endif
                                </td>
                                <td><a href="{{$product->slug['urn']}}">{{$product->name}}</a></td>
                                @foreach($product->params as $param)
                                    @if($param['active'] == true)
                                        <td>{{$param['value']}}</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </table>

                @endisset
                <div class="products-open-button">
                    <p class="offers-link">Показать еще</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        {!! $content !!}
    </div>

    @include('.elements.about')
    @include('.elements.consultation')

@endsection

@extends('layouts.main')

@section('content')
    <div class="content-block">
        @include('.elements.breadcrumbs')
        <div class="content-header">
            <h1>{{$title}}</h1>
        </div>
        @isset($introtext)
            <div class="content-intro">
                <p>{{$introtext}}</p>
            </div>
        @endisset
    </div>
    @isset($categories)
        <div class="categories-block">
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        @if(isset($category->images))
                            @foreach($category->images as $image)
                                <a href="/{{$category->slug['urn']}}" class="category-item" style="background-image: url('{{$image['200x150']}}')">
                                    <p class="category-name">{{$category['name']}}</p>
                                </a>
                                @break
                            @endforeach
                        @else
                            <a href="/{{$category->slug['urn']}}" class="category-item" style="background-image: url('/images/default-200x150.png')">
                                <p class="category-name">{{$category['name']}}</p>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endisset
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

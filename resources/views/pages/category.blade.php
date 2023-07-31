@extends('layouts.main')

@section('content')

    @if(!isset($pages) || $pages->currentPage() <= 1)
        <div class="categories">
            <div class="container">
                <div class="row categories-wrap">
                    <div class="col-lg-12">
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
                    <div class="col-lg-5">
                        @isset($introtext)
                            @foreach($introtext as $paragraph)
                                <p class="category-info">{{$paragraph}}</p>
                            @endforeach
                        @endisset
                        <div class="category-offer-button request-button" data-title="Запрос {{$title}}">
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

    @isset($products)
    <div class="products">
        <div class="container">
            <div class="row products-wrap products-wrap-close">
                <table class="products-table">
                    <tr>
                        <th></th>
                        <th>Модель</th>
                        @isset($products[0]->params)
                            @foreach($products[0]->params as $param)
                                @if($param['active'] == true)
                                    <th class="param-name-cell">{{$param['name']}}</th>
                                @endif
                            @endforeach
                        @endisset
                    </tr>
                    @foreach($products as $product)
                        <tr>
                            <td class="product-image-cell">
                                @if(isset($product->images))
                                    <img src="{{$product['images']['image-1']['200x150']}}" alt="{{$name}}">
                                @else
                                    <img src="/images/default-200x150.png" alt=" ">
                                @endif
                            </td>
                            <td><a href="{{$product->slug['urn']}}">{{$product->name}}</a></td>
                            @isset($product->params)
                                @foreach($product->params as $param)
                                    @if($param['active'] == true)
                                        <td>{{$param['value']}}</td>
                                    @endif
                                @endforeach
                            @endisset
                        </tr>
                    @endforeach
                </table>
                <div class="products-open-button">
                    <p class="offers-link">Показать еще</p>
                </div>
            </div>
        </div>
    </div>
    @endisset

    @isset($solution_text)
    <div class="category-complete-solution">
        <div class="container">
            <div class="row complete-solution-wrap">
                <div class="col-lg-12">
                    <div class="solution-headers">
                        <h2>Комплексные решения</h2>
                    </div>
                </div>
                <div class="col-lg-5">
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
                <div class="col-lg-7">
                    <div class="solution-image">
                        <img src="{{ $solution_image }}" alt="{{$name}} - Комплексное решение">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset

    @isset($pages)
        <div class="child-pages">
            <div class="container">
                <div class="row child-pages-wrap">
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach($pages as $item)
                                <div class="col-lg-4">
                                    <div class="child-page-block">
                                        @if(isset($item->images))
                                            <div class="child-page-image" style="background-image: url('{{json_decode($item->images, true)['image-1']['400x300']}}')"></div>
                                        @else
                                            <div class="child-page-image" style="background-image: url('/images/default-400x300.png')"></div>
                                        @endif
                                        <div class="child-page-header">
                                            <a href="{{$item->urn}}">{{$item->title}}</a>
                                        </div>
                                        <div class="child-page-text">
                                            <p>{{$item->introtext}}</p>
                                        </div>
                                        <div class="child-page-date">
                                            <p>{{$item->updated_at->format('d.m.Y')}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{$pages->links()}}
            </div>
        </div>
    @endisset

    @isset($content)
        @include('.elements.content')
    @endisset

    @isset($advantages)
        @include('.elements.advantages', ['advantagesHeader' => 'Преимущества', 'advantagesIntro' => 'превосходство в деталях'])
    @endisset

    @isset($specialOffer)
        @include('.elements.special-offer')
    @endisset

    @isset($related_page_text)
    <div class="related-block">
        <div class="container">
            <div class="row related-block-wrap">
                <div class="col-lg-12">
                    <div class="related-block-headers">
                        <h3>Сопутствующее оборудование</h3>
                    </div>
                </div>
                <div class="col-lg-5">
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
                <div class="col-lg-7">
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

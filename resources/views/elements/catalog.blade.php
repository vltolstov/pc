<div class="catalog">
    <div class="container">
        <div class="row catalog-wrap">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <div class="catalog-headers">
                    <h3>Каталог</h3>
                    <p>Литейное оборудование</p>
                </div>
                <p class="catalog-info">Многолетний опыт компании {{$companyName}} основан на тщательном отборе лучших производителей металлургического и литейного оборудования, а также на отлаженной логистике и многоступенчатом контроле качества.</p>
                <p class="catalog-info">Наличие эксклюзивных контрактов и сбалансированной системы минимизации расходов исключают завышение стоимости ввиду отсутствия посредников.</p>
                <div class="catalog-button">
                    <a href="/katalog">Показать еще</a>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="row">
                    @isset($categories)
                        @foreach($categories as $category)
                            <div class="col-lg-4 col-md-4 col-sm-4">
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
                </div>
            </div>
        </div>
    </div>
</div>

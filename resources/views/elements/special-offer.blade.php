<div class="special-offer">
    <div class="container">
        <div class="row special-offer-wrap">
            <div class="col-lg-12">
                <div class="special-offer-headers">
                    <h3>Специальные предложения и акции</h3>
                    <p>Оборудование по низким ценам</p>
                </div>
                <div class="row special-offer-flex">
                    <div class="special-offer-info col-lg-4 order-3">
                        <p class="special-offer-name">{{$specialOffer->name}}</p>
                        <p class="special-offer-price">{{$specialOffer->offer_price}} руб.<br><span>в наличии</span></p>
                    </div>
                    <div class="special-offer-text col-lg-4 order-2">
                        @isset($specialOffer->introtext)
                            @foreach($specialOffer->introtext as $paragraph)
                                <p>{{$paragraph}}</p>
                            @endforeach
                        @endisset
                    </div>
                    <div class="special-offer-image col-lg-4 order-1">
                        @if(isset($specialOffer->image))
                            <img src="{{json_decode($specialOffer->image, true)['image-1']['200x150']}}" alt="{{$title}}">
                        @else
                            <img src="/images/default-800x600.png" alt=" ">
                        @endif
                    </div>
                </div>
                <div class="special-offer-button request-button" data-title="Запрос специального предложения: {{$specialOffer->name}}">
                    <p>Запросить спецификацию и счет</p>
                </div>
            </div>
        </div>
    </div>
</div>

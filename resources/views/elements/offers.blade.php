<div class="offers">
    <div class="container">
        <div class="row offers-wrap offers-wrap-close">
            @foreach($offers as $offer)
                <div class="col-lg-4">
                    @if(isset($offer->image))
                        <a href="{{$offer->urn}}" class="offer" style="background-image: url('{{json_decode($offer->image, true)['image-1']['200x150']}}')">
                    @else
                        <a href="{{$offer->urn}}" class="offer" style="background-image: url('/images/default-200x150.png')">
                    @endif
                        <p class="offer-title">{{$offer->name}}</p>
                        <p class="offer-price">{{$offer->offer_price}} руб.</p>
                    </a>
                </div>
            @endforeach
            <div class="offers-open-button">
                <p class="offers-link">Показать еще</p>
            </div>
        </div>
    </div>
</div>

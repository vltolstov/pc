@extends('layouts.main')

@section('index')

    @include('.elements.slider')
    @include('.elements.offers')
    @include('.elements.map')
    @include('.elements.special-offer')
    @include('.elements.catalog')
    @isset($advantages)
        @include('.elements.advantages', ['advantagesHeader' => 'Преимущества работы с нами', 'advantagesIntro' => 'превосходство в деталях'])
    @endisset
    @include('.elements.news')
    @include('.elements.about')
    @include('.elements.consultation')

@endsection










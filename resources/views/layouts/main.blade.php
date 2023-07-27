<!DOCTYPE html>
<html lang="ru">

<head>

    <base href="{{$baseUrl}}">
    <title>{{$title}}</title>
    <meta name="description" content="{{$description}}">
    <meta name="keywords" content="{{$keywords}}">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta property="og:site_name" content="{{$siteName}}">
    <meta property="og:title" content="{{$title}}">
    <meta property="og:description" content="{{$description}}">
    <meta property="og:type" content="website">
    <meta property="og:url" content= "{{$baseUrl}}/{{$urn}}">

    @if(isset($images))
        @foreach($images as $image)
            <meta property="og:image" content="{{$baseUrl}}{{$image['800x600']}}">
            <meta property="og:image:width" content="800">
            <meta property="og:image:height" content="600">
            <link rel="image_src" href="{{$baseUrl}}{{$image['800x600']}}">
            @break
        @endforeach
    @endif

    @vite('resources/css/app.css')

    <link rel="canonical" href="{{$baseUrl}}/{{$urn}}"/>

    <link rel="icon" type="image/png" href="/favicon-196x196.png" sizes="196x196">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">

</head>
<body>

@include('.elements.main-menu')

<div class="body-flex">
    @include('.elements.header')

    @if($id != 1)
        @include('.elements.breadcrumbs')
        @section('content')
        @show
    @else
        @section('index')
        @show
    @endif

    @include('.elements.footer')
</div>

@include('.elements.modal-form')
@include('.elements.counts')

@vite('resources/js/app.js')

</body>
</html>

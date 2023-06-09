@extends('.layouts.main')

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
    <div class="content">
        {!! $content !!}
    </div>
@endsection

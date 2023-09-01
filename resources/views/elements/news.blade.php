<div class="news">
    <div class="container">
        <div class="row news-headers-wrap">
            <div class="col-lg-12 col-md-12">
                <div class="news-headers">
                    <h3>Новости</h3>
                    <p>Самое важное</p>
                </div>
            </div>
        </div>
        <div class="row news-wrap">
            <div class="col-lg-12 col-md-12">
                <div class="row flex">

                    <div class="col-lg-4 col-md-4">
                        <div class="news-block">
                            <div class="news-header news-special">
                                <a href="{{$priorityNews->urn}}">{{$priorityNews->title}}</a>
                            </div>
                            <div class="news-text">
                                <p>{{$priorityNews->introtext}}</p>
                            </div>
                            <div class="news-date">
                                <p>{{$priorityNews->updated_at->format('d.m.Y')}}</p>
                            </div>
                        </div>
                    </div>

                    @foreach($news as $item)
                        <div class="col-lg-4 col-md-4">
                            <div class="news-block">
                                <div class="news-header">
                                    <a href="{{$item->urn}}">{{$item->title}}</a>
                                </div>
                                <div class="news-text">
                                    <p>{{$item->introtext}}</p>
                                </div>
                                <div class="news-date">
                                    <p>{{$item->updated_at->format('d.m.Y')}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="news-button">
            <a href="/novosti">Показать еще</a>
        </div>
    </div>
</div>

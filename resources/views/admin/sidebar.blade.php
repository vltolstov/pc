<div class="admin-main-menu">
    <p class="admin-menu-header">Основное меню <a href="{{route('page.create')}}" class="create-new">(Добавить страницу)</a></p>
    <ul>
        @foreach($menuPages as $page)
            <li><a href="/admin/page/{{$page->id}}/edit">{{$page->name}}</a></li>
        @endforeach
    </ul>
</div>


@isset($pages)
    <div class="admin-sub-menu">
        <p class="admin-menu-header">Подменю</p>
        <ul>
            @foreach($pages as $page)
                <li>
                    @if(isset($page->image))
                        @foreach(json_decode($page->image, true) as $image)
                            <img src="{{$image['200x150']}}">
                            @break
                        @endforeach
                    @else
                        <img src="/images/default-200x150.png">
                    @endif
                    @if($page->active)
                        <a href="/admin/page/{{$page->id}}/edit">{{$page->name}}</a>
                        @else
                        <a href="/admin/page/{{$page->id}}/edit"><s>{{$page->name}}</s></a>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endisset


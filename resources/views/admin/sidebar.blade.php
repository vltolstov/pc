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
                <li><a href="/admin/page/{{$page->id}}/edit">{{$page->name}}</a></li>
            @endforeach
        </ul>
    </div>
@endisset


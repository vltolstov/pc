@if (count($menuItems->where('parent_id', $parent)))
    <ul class="main-menu">
        @foreach ($menuItems->where('parent_id', $parent) as $item)
            <li><a href="{{$item['urn']}}">{{ $item->name }}</a>
                @include('.elements.menu', ['parent' => $item->page_id])
            </li>
        @endforeach
    </ul>
@endif

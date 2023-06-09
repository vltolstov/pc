@if ($menuItems->where('page_id', $parents))
    @foreach ($menuItems->where('page_id', $parents) as $parent)
        @include('.elements.breadItem', ['parents' => $parent->parent_id])
        @if ($parent->page_id == $id)
            <span>{{ $parent->name }}</span>
        @else
            <a href="{{$parent['urn']}}">{{ $parent->name }}</a> /
        @endif
    @endforeach
@endif

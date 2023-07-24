@if ($paginator->hasPages())
    <div class="paginatation-block">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <div class="pagination-item pagination-inactive-item">
                {!! __('pagination.previous') !!}
            </div>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-item pagination-active-item">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-item pagination-active-item">
                {!! __('pagination.next') !!}
            </a>
        @else
            <div class="pagination-item pagination-inactive-item">
                {!! __('pagination.next') !!}
            </div>
        @endif
    </div>
@endif

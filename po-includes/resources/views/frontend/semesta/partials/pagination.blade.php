@if ($paginator->hasPages())

    <div class="btn-pagination-container">
        @if ($paginator->onFirstPage())
            <button class="btn btn-secondary btn-pagination btn-disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"><i class="fa fa-chevron-left"></i></button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-secondary btn-pagination" rel="prev" aria-label="@lang('pagination.previous')"><i class="fa fa-chevron-left"></i></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <button class="btn btn-secondary btn-pagination btn-disabled" aria-disabled="true"><span>{{ $element }}</span></button>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button class="btn btn-secondary btn-pagination btn-page-active" aria-current="page"><span>{{ $page }}</span></button>
                    @else
                        <a href="{{ $url }}" class="btn btn-secondary btn-pagination" style="text-align: center">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-secondary btn-pagination" rel="next" aria-label="@lang('pagination.next')"><i class="fa fa-chevron-right"></i></a>
        @else
            <button class="btn btn-secondary btn-pagination btn-disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <i class="fa fa-chevron-right"></i>
            </button>
        @endif
    </div>
@endif

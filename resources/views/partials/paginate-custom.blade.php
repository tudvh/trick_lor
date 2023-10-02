@php
$onEachSide = isset($onEachSide) ? $onEachSide : 2;
$currentPage = $paginator->currentPage();
$lastPage = $paginator->lastPage();
@endphp

@if ($paginator->hasPages())
<nav>
    <div class="d-flex justify-content-center align-items-center">
        <ul class="pagination gap-2 flex-wrap justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&larr;</span>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&larr;</a>
            </li>
            @endif

            {{-- First Page Link --}}
            @if ($currentPage >= $onEachSide + 3)
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
            </li>
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">...</span>
            </li>
            @elseif ($currentPage >= $onEachSide + 2)
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
            </li>
            @endif

            {{-- Pagination Elements --}}
            @for ($page = max(1, $currentPage - $onEachSide); $page <= min($currentPage + $onEachSide, $lastPage); $page++) @if ($page==$currentPage) <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @endif
                @endfor

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rarr;</a>
                </li>
                @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rarr;</span>
                </li>
                @endif
        </ul>
    </div>
</nav>
@endif
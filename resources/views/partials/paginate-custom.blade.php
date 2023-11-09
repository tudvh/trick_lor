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
            @if ($currentPage >= $onEachSide + 2)
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="fa-regular fa-angle-left"></i>
                </a>
            </li>
            @endif

            {{-- Pagination Elements --}}
            @for ($page = max(1, $currentPage - $onEachSide); $page <= min($currentPage + $onEachSide, $lastPage); $page++) @if ($page==$currentPage) <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @endif
                @endfor

                {{-- Next Page Link --}}
                @if ($currentPage <= $lastPage - $onEachSide - 2) <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="fa-regular fa-angle-right"></i>
                    </a>
                    </li>
                    @endif
        </ul>
    </div>
</nav>
@endif
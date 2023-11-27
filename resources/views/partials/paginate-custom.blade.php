@php
$onEachSide = isset($onEachSide) ? $onEachSide : 2;
$currentPage = $paginator->currentPage();
$lastPage = $paginator->lastPage();
@endphp

@if ($paginator->hasPages())
<nav>
    <div class="d-flex justify-content-center align-items-center">
        <ul class="pagination gap-2 flex-wrap justify-content-center">
            {{-- Pagination Elements --}}
            @for ($page = max(1, $currentPage - $onEachSide); $page <= min($currentPage + $onEachSide, $lastPage); $page++) @if ($page==$currentPage) <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @endif
                @endfor
        </ul>
    </div>
</nav>
@endif
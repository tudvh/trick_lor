@props(['columns' => [], 'sortColumn' => '', 'sortType' => 'asc'])

<tr>
    @foreach ($columns as $column)
        @php
            $columnName = $column['name'] ?? '';
            $columnDisplayName = $column['displayName'] ?? '';
            $isSort = $column['isSort'] ?? false;
        @endphp

        <th>
            @if ($isSort)
                <button type="button" class="w-100 d-flex justify-content-center align-items-center gap-2 pe-auto"
                    wire:click="sort('{{ $columnName }}')">
                    <strong>{{ $columnDisplayName }}</strong>
                    @if ($sortColumn == $columnName)
                        <i class="fa-solid {{ $sortType == 'asc' ? 'fa-caret-up' : 'fa-caret-down' }} "></i>
                    @endif
                </button>
            @else
                {{ $columnDisplayName }}
            @endif
        </th>
    @endforeach
</tr>

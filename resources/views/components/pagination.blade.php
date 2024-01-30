<div class="blog__c-pag">
    @if (!$data->onFirstPage())
        <a href="{{ $data->previousPageUrl() }}">
            <span class="material-icons">chevron_left</span>
        </a>
    @endif
    @php
        $start = $data->currentPage() < 3 ? 1 : $data->currentPage() - 2;
        $end = $data->lastPage() < 3 ? $data->lastPage() : ($data->currentPage() + 3 > $data->lastPage() ? $data->lastPage() : $data->currentPage() + 3);
    @endphp
    @for ($i = $start; $i <= $end; $i++)
        @if (request('page') == $i || (request('page') == null && $i == 1))
            <a href="{{ $data->url($i) }}" class="active-page">{{ $i }}</a>
        @else
            <a href="{{ $data->url($i) }}">{{ $i }}</a>
        @endif
    @endfor
    @if ($data->hasMorePages())
        <a href="{{ $data->nextPageUrl() }}">
            <span class="material-icons">chevron_right</span>
        </a>
    @endif
</div>

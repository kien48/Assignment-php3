<!-- resources/views/vendor/pagination/custom.blade.php -->

@if ($paginator->hasPages())
    <ul class="pagination justify-content-center">
        {{-- Liên kết Trang Trước --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">&laquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
            </li>
        @endif

        {{-- Các liên kết trang --}}
        @foreach ($elements as $element)
            {{-- Liên kết các số trang --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Liên kết các trang số --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Liên kết Trang Sau --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">&raquo;</span>
            </li>
        @endif
    </ul>
@endif

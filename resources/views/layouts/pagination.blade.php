@if ($paginator->hasPages())
    <div style="margin-top: 10px; margin-right: 25px;">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item prev disabled">
                        <a class="page-link" href="javascript:void(0);">
                            <i class="tf-icon bx bx-chevrons-left"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item prev">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                            <i class="tf-icon bx bx-chevrons-left"></i>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @php
                    $current = $paginator->currentPage();
                    $total = $paginator->lastPage();
                    $start = $current - 1 > 0 ? $current - 1 : 1;
                    $end = $start + 2 <= $total ? $start + 2 : $total;

                    if ($end - $start < 2) {
                        $start = $end - 2 > 0 ? $end - 2 : 1;
                    }
                @endphp

                {{-- First Page Link --}}
                @if ($start > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                    </li>
                    @if ($start > 2)
                        <li class="page-item disabled">
                            <a class="page-link" href="javascript:void(0);">...</a>
                        </li>
                    @endif
                @endif

                {{-- Page Links --}}
                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $current)
                        <li class="page-item active">
                            <a class="page-link" href="javascript:void(0);">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                        </li>
                    @endif
                @endfor

                {{-- Last Page Link --}}
                @if ($end < $total)
                    @if ($end < $total - 1)
                        <li class="page-item disabled">
                            <a class="page-link" href="javascript:void(0);">...</a>
                        </li>
                    @endif
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($total) }}">{{ $total }}</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item next">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                            <i class="tf-icon bx bx-chevrons-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item next disabled">
                        <a class="page-link" href="javascript:void(0);">
                            <i class="tf-icon bx bx-chevrons-right"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif

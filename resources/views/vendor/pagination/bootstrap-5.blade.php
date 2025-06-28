@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination pagination-sm mb-0">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link border-0 bg-light text-muted">
                            <i class="fas fa-chevron-left me-1"></i>Sebelumnya
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link border-0 bg-white text-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                            <i class="fas fa-chevron-left me-1"></i>Sebelumnya
                        </a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link border-0 bg-white text-primary" href="{{ $paginator->nextPageUrl() }}" rel="next">
                            Selanjutnya<i class="fas fa-chevron-right ms-1"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link border-0 bg-light text-muted">
                            Selanjutnya<i class="fas fa-chevron-right ms-1"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted mb-0">
                    Menampilkan
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    sampai
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    dari
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    data
                </p>
            </div>

            <div>
                <ul class="pagination pagination-sm mb-0">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="Sebelumnya">
                            <span class="page-link border-0 bg-light text-muted" aria-hidden="true">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link border-0 bg-white text-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Sebelumnya">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link border-0 bg-light text-muted">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link border-0 bg-primary text-white">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link border-0 bg-white text-primary" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link border-0 bg-white text-primary" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Selanjutnya">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="Selanjutnya">
                            <span class="page-link border-0 bg-light text-muted" aria-hidden="true">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif

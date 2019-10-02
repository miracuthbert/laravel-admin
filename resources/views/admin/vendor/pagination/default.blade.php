@if ($paginator->hasPages())
    <div class="justify-start sm:justify-center md:justify-end lg:justify-between xl:justify-around my-4"
         role="navigation">
        <div class="flex-wrap inline-flex">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <div class="lg:flex-1 text-grey text-center bg-grey-light rounded m-2 disabled"
                     aria-disabled="true"
                     aria-label="@lang('pagination.previous')">
                    <span class="text-grey no-underline block px-4 py-2" aria-hidden="true">&lsaquo;</span>
                </div>
            @else
                <div class="lg:flex-1 text-grey-darker text-center bg-grey-light rounded m-2 hover:bg-teal-dark">
                    <a class="text-blue-darker no-underline hover:text-white block px-4 py-2"
                       href="{{ $paginator->previousPageUrl() }}"
                       rel="prev"
                       aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </div>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <div class="lg:flex-1 text-grey-darker text-center bg-grey-light rounded m-2 disabled"
                         aria-disabled="true">
                        <span class="text-blue-darker no-underline block px-4 py-2">{{ $element }}</span>
                    </div>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <div class="lg:flex-1 shadow text-white text-center bg-teal-dark rounded m-2 disabled outline-none shadow-outline"
                                 aria-current="page">
                                <span class="text-white no-underline block px-4 py-2">{{ $page }}</span>
                            </div>
                        @else
                            <div class="lg:flex-1 text-grey-darker text-center bg-grey-light rounded m-2 hover:bg-teal-dark">
                                <a class="text-blue-darker no-underline hover:text-white block px-4 py-2"
                                   href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <div class="lg:flex-1 text-grey-darker text-center bg-grey-light rounded m-2 hover:bg-teal-dark">
                    <a class="text-blue-darker no-underline hover:text-white block px-4 py-2"
                       href="{{ $paginator->nextPageUrl() }}"
                       rel="next"
                       aria-label="@lang('pagination.next')">&rsaquo;</a>
                </div>
            @else
                <div class="lg:flex-1 text-grey text-center bg-grey-light rounded m-2 disabled"
                     aria-disabled="true"
                     aria-label="@lang('pagination.next')">
                    <span class="text-grey no-underline block px-4 py-2" aria-hidden="true">&rsaquo;</span>
                </div>
            @endif
        </div><!-- /.inline-flex -->
    </div>
@endif

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center">
        <div class="flex flex-col gap-4 sm:hidden">
            <div class="bg-primary rounded-3xl">
                <p class="text-sm text-center text-white leading-5 p-2">
                    <i class="fa-solid fa-circle-check mr-1"></i>
                    {!! __('全') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('件中') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('件目まで表示') !!}
                </p>
            </div>
            <div class="flex justify-between flex-1 sm:hidden">
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-400 border border-gray-300 cursor-default leading-5 rounded-md">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-chevron-left"></i>{!! __('pagination.previous') !!}
                        </div>
                    </span>
                @else
                    @if (request()->query('sort') && request()->query('sort') === 'top')
                        <a href="{{ $paginator->previousPageUrl() . '&sort=top' }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-purple-500 active:text-gray-700 transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-chevron-left"></i>{!! __('pagination.previous') !!}
                            </div>
                        </a>
                    @elseif (request()->query('sort') && request()->query('sort') === 'corrects')
                        <a href="{{ $paginator->previousPageUrl() . '&sort=corrects' }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-purple-500 active:text-gray-700 transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-chevron-left"></i>{!! __('pagination.previous') !!}
                            </div>
                        </a>
                    @elseif (request()->query('sort') && request()->query('sort') === 'posts')
                        <a href="{{ $paginator->previousPageUrl() . '&sort=posts' }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-purple-500 active:text-gray-700 transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-chevron-left"></i>{!! __('pagination.previous') !!}
                            </div>
                        </a>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-purple-500 active:text-gray-700 transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-chevron-left"></i>{!! __('pagination.previous') !!}
                            </div>
                        </a>
                    @endif
                @endif
    
                @if ($paginator->hasMorePages())
                    @if (request()->query('sort') && request()->query('sort') === 'top')
                        <a href="{{ $paginator->nextPageUrl() . '&sort=tops' }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-white bg-primary border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-purple-500 active:text-gray-700 transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                {!! __('pagination.next') !!}<i class="fa-solid fa-circle-chevron-right"></i>
                            </div>
                        </a>
                    @elseif (request()->query('sort') && request()->query('sort') === 'corrects')
                        <a href="{{ $paginator->nextPageUrl() . '&sort=corrects' }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-white bg-primary border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-purple-500 active:text-gray-700 transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                {!! __('pagination.next') !!}<i class="fa-solid fa-circle-chevron-right"></i>
                            </div>
                        </a>
                    @elseif (request()->query('sort') && request()->query('sort') === 'posts')
                        <a href="{{ $paginator->nextPageUrl() . '&sort=posts' }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-white bg-primary border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-purple-500 active:text-gray-700 transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                {!! __('pagination.next') !!}<i class="fa-solid fa-circle-chevron-right"></i>
                            </div>
                        </a>
                    @else
                        <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-white bg-primary border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-purple-500 active:text-gray-700 transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                {!! __('pagination.next') !!}<i class="fa-solid fa-circle-chevron-right"></i>
                            </div>
                        </a>
                    @endif
                @else
                    <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-white bg-gray-400 border border-gray-300 cursor-default leading-5 rounded-md">
                        <div class="flex items-center gap-2">
                            {!! __('pagination.next') !!}<i class="fa-solid fa-circle-chevron-right"></i>
                        </div>
                    </span>
                @endif
            </div>
        </div>

        <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div class="hidden sm:block bg-primary rounded-3xl">
                <p class="text-sm text-white leading-5 p-2">
                    <i class="fa-solid fa-circle-check mr-1"></i>
                    {!! __('全') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('件中') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('件目まで表示') !!}
                </p>
            </div>

            <div class="hidden sm:block">
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-white bg-yellow-400 border border-gray-300 cursor-default rounded-l-md leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-white bg-yellow-400 border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-purple-500 active:text-gray-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-yellow-400 border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-purple-600 border border-gray-300 cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-yellow-400 border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-purple-500 active:text-gray-700 transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-white bg-yellow-400 border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-purple-500 active:text-gray-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-white bg-yellow-400 border border-gray-300 cursor-default rounded-r-md leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif

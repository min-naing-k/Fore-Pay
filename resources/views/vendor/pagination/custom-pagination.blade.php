@if ($paginator->hasPages())
  {{-- Desktop View --}}
  <div class="pagination-wrapper hidden md:flex items-center justify-between flex-wrap gap-y-2">
    <div class="flex-shrink-0">
      <p class="text-gray-500 text-sm">Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} Admins</p>
    </div>

    <ul class="pagination flex text-sm">
      {{-- 1,2,3,4,5,6,7,8,9,10,11,12,13 total(13) --}}

      {{-- Previous Page Link --}}
      @if ($paginator->onFirstPage())
        <li class="disabled">
          <span class="page-link link">
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
              </svg>
            </div>
          </span>
        </li>
      @else
        <li class="">
          <a class="page-link link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
              </svg>
            </div>
          </a>
        </li>
      @endif

      @if (count($elements[0]) <= 6 && $paginator->currentPage() <= 6)
        @foreach (range(1, count($elements[0])) as $i)
          @if ($i == $paginator->currentPage())
            <li><span class="page-link active link">{{ $i }}</span></li>
          @else
            <li class=""><a class="page-link link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
          @endif
        @endforeach
      @elseif(count($elements[0]) <= 7 && $paginator->currentPage() <= 7)
        {{-- only 7 --}}
        @if ($paginator->currentPage() >= 5)
          <li class="hidden-xs "><a class="page-link link" href="{{ $paginator->url(1) }}">1</a></li>
          <li class="hidden-xs "><a class="page-link link" href="{{ $paginator->url(2) }}">2</a></li>
          <li class=""><span class="page-link link">...</span></li>
        @endif
        {{-- 1, ... (currentPage == over 4) --}}
        @if ($paginator->currentPage() == 4)
          <li class="hidden-xs "><a class="page-link link" href="{{ $paginator->url(1) }}">1</a></li>
          <li class=""><span class="page-link link">...</span></li>
        @endif

        @foreach (range(1, count($elements[0])) as $i)
          @if ($paginator->currentPage() <= 3 && $i <= 4)
            @if ($i == $paginator->currentPage())
              <li><span class="active page-link link">{{ $i }}</span></li>
            @else
              <li class=""><a class="page-link link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
          @else
            {{-- between (3, 4, 5) --}}
            @if ($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 1)
              @if ($i == $paginator->currentPage())
                <li><span class="active page-link link">{{ $i }}</span></li>
              @else
                <li class=""><a class="page-link link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
              @endif
            @else
              @if ($paginator->currentPage() >= 5 && $i >= 4)
                @if ($i == $paginator->currentPage())
                  <li><span class="active page-link link">{{ $i }}</span></li>
                @else
                  <li class=""><a class="page-link link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
              @endif
            @endif
          @endif
        @endforeach
        {{-- ..., 6,7 (currentPage == over 4) --}}
        @if ($paginator->currentPage() <= 3)
          <li class=""><span class="page-link link">...</span></li>
          <li class="hidden-xs "><a class="page-link link" href="{{ $paginator->url($paginator->lastPage() - 1) }}">{{ $paginator->lastPage() - 1 }}</a></li>
          <li class="hidden-xs "><a class="page-link link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
        @endif

        @if ($paginator->currentPage() == 4)
          <li class=""><span class="page-link link">...</span></li>
          <li class="hidden-xs "><a class="page-link link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
        @endif

      @else
        {{-- 1, 2, ... (currentPage == over 4) --}}
        @if ($paginator->currentPage() >= 5)
          <li class="hidden-xs "><a class="page-link link" href="{{ $paginator->url(1) }}">1</a></li>
          <li class="hidden-xs "><a class="page-link link" href="{{ $paginator->url(2) }}">2</a></li>
          <li class=""><span class="page-link link">...</span></li>
        @endif

        {{-- clone original array and generate new array --}}
        @foreach (range(1, $paginator->lastPage()) as $i)
          @if ($paginator->currentPage() < 5)
            {{-- output first 5 numbers if current is 1 and under 3    1 2 3 4 (currentPage == 1, 2, 3) --}}
            @if ($i <= 5)
              @if ($i == $paginator->currentPage())
                <li><span class="active page-link link">{{ $i }}</span></li>
              @else
                <li class=""><a class="page-link link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
              @endif
            @endif
          @else
            {{-- 3, 4, 5 (currentPage == 4 and under 11) --}}
            @if ($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 1 && $paginator->currentPage() <= $paginator->lastPage() - 4)
              {{-- {{ 'between' . $i }} --}}
              @if ($i == $paginator->currentPage())
                <li><span class="active page-link link">{{ $i }}</span></li>
              @else
                <li class=""><a class="page-link link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
              @endif
            @else
              {{-- output last 4 numbers if current is 11 and over    10, 11, 12, 13 (currentPage == 11, 12, 13) --}}
              @if ($i >= $paginator->lastPage() - 4 && $paginator->currentPage() > $paginator->lastPage() - 4)
                {{-- {{ 'end' . $i }} --}}
                @if ($i == $paginator->currentPage())
                  <li><span class="active page-link link">{{ $i }}</span></li>
                @else
                  <li class=""><a class="page-link link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
              @endif
            @endif
          @endif
        @endforeach

        {{-- ..., 12, 13 (currentPage == under 11) --}}
        @if ($paginator->currentPage() < $paginator->lastPage() - 3)
          <li class=""><span class="page-link link">...</span></li>
          <li class="hidden-xs "><a class="page-link link" href="{{ $paginator->url($paginator->lastPage() - 1) }}">{{ $paginator->lastPage() - 1 }}</a></li>
          <li class="hidden-xs "><a class="page-link link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
        @endif
      @endif

      {{-- Next Page Link --}}
      @if ($paginator->hasMorePages())
        <li class="">
          <a class="page-link link" href="{{ $paginator->nextPageUrl() }}" rel="next">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
            </svg>
          </a>
        </li>
      @else
        <li class="disabled">
          <span class="page-link link">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
            </svg>
          </span>
        </li>
      @endif
    </ul>
  </div>
  {{-- Mobile View --}}
  <div class="flex items-center justify-between md:hidden">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <span class="page-link w-20 flex items-center justify-center px-3 py-2 border border-gray-200 rounded-lg bg-white text-gray-300 text-sm cursor-not-allowed">
        Previous
      </span>
    @else
      <a
        class="page-link w-20 flex items-center justify-center px-3 py-2 border border-gray-200 rounded-lg bg-white text-gray-500 text-sm focus:ring-2 ring-indigo-500 ring-offset-2"
        href="{{ $paginator->previousPageUrl() }}" rel="prev">
        Previous
      </a>
    @endif

    <div>
      <p class="text-gray-500 text-sm">{{ $paginator->currentPage() }} of {{ $paginator->lastPage() }} pages</p>
    </div>

    {{-- Next Page Link --}}
    @if ($paginator->onLastPage())
      <span class="page-link w-20 flex items-center justify-center px-3 py-2 border border-gray-200 rounded-lg bg-white text-gray-300 text-sm cursor-not-allowed">
        Next
      </span>
    @else
      <a class="page-link w-20 flex items-center justify-center px-3 py-2 border border-gray-200 rounded-lg bg-white text-gray-500 text-sm focus:ring-2 ring-indigo-500 ring-offset-2"
        href="{{ $paginator->nextPageUrl() }}" rel="prev">
        Next
      </a>
    @endif
  </div>
@endif

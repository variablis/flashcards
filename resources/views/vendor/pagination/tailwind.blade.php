@if ($paginator->hasPages())
    <nav role="Page navigation" aria-label="{{ __('Pagination Navigation') }}" >

        <div class="flex flex-col items-center">

            <!-- Help text -->
            <span class="text-sm text-gray-700 dark:text-gray-400">
                {!! __('Showing') !!} 
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ $paginator->firstItem() }}
            </span> 
                {!! __('to') !!} 
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ $paginator->lastItem() }}
            </span> 
                {!! __('of') !!} 
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ $paginator->total() }}
            </span>
                {!! __('results') !!}
            </span>

            <!-- Buttons -->
            <div class="inline-flex mt-2 xs:mt-0">
                @if ($paginator->onFirstPage())
                <button class="px-4 py-2 text-sm font-medium text-gray-300 bg-white border border-gray-300 rounded-l hover:bg-gray-100 hover:text-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Prev</button>
                @else
                <a class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="{{ $paginator->previousPageUrl() }}">Prev</a>
                @endif

                @if ($paginator->hasMorePages())
                <a class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-l-0 border-gray-300 rounded-r hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="{{ $paginator->nextPageUrl() }}">Next</a>
                @else
                <button class="px-4 py-2 text-sm font-medium text-gray-300 bg-white border border-l-0 border-gray-300 rounded-r hover:bg-gray-100 hover:text-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</button>
                @endif
            </div>
          </div>
          
    </nav>
@endif


    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-96 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">

            @if ($xowns)
            
                <a href="{{ route('topics.create') }}" class="text-md leading-6 font-medium text-gray-900">new topic</a>
            @endif

           <ul class="space-y-2 font-medium">

            @if ($xowns)
            <li>
                <a href="{{ route($attr2.'.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="ml-3">All</span>
                    {{ request()->routeIs($attr2.'.index') }}
                </a>
            </li>
            @endif

            @foreach ($attributeName as $t)
                <li>
                    <a href="{{ route($attr2.'.show', $t->id ) }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        <span class="ml-3">{{ $t->title }}</span>
                        {{ request()->route('id') == $t->id && request()->routeIs($attr2.'.show') }}
                    </a>
                </li>
            @endforeach
              
           </ul>
        </div>
     </aside>

     {{-- <div class=" p-4 sm:p-6 lg:p-8"> --}}
    {{-- <x-primary-button class="mt-4">{{ __('New Topic') }}</x-primary-button> --}}

    {{-- @if ($xowns)
    <a href="{{ route('topics.create') }}" class="text-md leading-6 font-medium text-gray-900">new topic</a>
    @endif --}}

    {{-- <ul class="bg-white shadow overflow-hidden sm:rounded-md ">

        @if ($xowns)
        <li class="border-t border-gray-200 p-4">
            <a href="{{ route($attr2.'.index') }}" class="text-md leading-6 font-medium text-gray-900">All</a>
            {{ request()->routeIs($attr2.'.index') }}
        </li>
        @endif

        @foreach ($attributeName as $t)
        <li class="border-t border-gray-200 p-4">
            <a href="{{ route($attr2.'.show', $t->id ) }}" class="text-md leading-6 font-medium text-gray-900">{{ $t->title }}</a>
           
            {{ request()->route('id') == $t->id && request()->routeIs($attr2.'.show') }}
        </li>
        @endforeach
    </ul> --}}

{{-- </div> --}}


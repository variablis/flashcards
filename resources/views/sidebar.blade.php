<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-96 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">

        {{$sidename}}
        
        <ul class="space-y-2 font-medium">

        @if ($xowns)
        <li>
            <x-my-sidebar-link :href="route($attr2.'.index')" :active="request()->routeIs($attr2.'.index')">
                {{ __('All') }}
            </x-my-sidebar-link>
        </li>
        @endif

        @foreach ($attributeName as $t)
        <li>
            <x-my-sidebar-link :href="route($attr2.'.show', $t->id )" :active="request()->route('id') == $t->id && request()->routeIs($attr2.'.show')">
                {{ $t->title }}
            </x-my-sidebar-link>
        </li>
        @endforeach
            
        </ul>
    </div>
    </aside>

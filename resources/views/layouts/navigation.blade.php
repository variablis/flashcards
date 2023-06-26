<nav class="bg-white dark:bg-gray-900 fixed w-full z-50 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
    <div class=" flex flex-wrap items-center justify-between mx-auto p-4">

    <a href="{{ route('expl') }}" class="flex items-center">
        <x-application-logo class="mr-3 block h-8 w-auto fill-current text-gray-800" />
        <span class="self-center text-xl font-bold tracking-tight sm:text-2xl whitespace-nowrap dark:text-white">Flashcards</span>
    </a>

    <div class="flex md:order-2">
        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Get started</button>
        <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
        </button>
    </div>

    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
            <x-my-nav-link :href="route('expl')" :active="request()->routeIs('expl')">
                {{ __('Explore') }}
            </x-my-nav-link>
        </li>
        <li>
            <x-my-nav-link :href="route('decks.index')" :active="request()->routeIs('decks.index')">
                {{ __('My Decks') }}
            </x-my-nav-link>
        </li>
        <li>
            <x-my-nav-link :href="route('flashcards.index')" :active="request()->routeIs('flashcards.index')">
                {{ __('My Flashcards') }}
            </x-my-nav-link>
        </li>

      </ul>
    </div>
    </div>
  </nav>
  
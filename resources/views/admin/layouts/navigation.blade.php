<nav class="bg-white dark:bg-gray-900 fixed w-full z-50 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
    <div class=" flex flex-wrap items-center justify-between mx-auto p-4">

        <div class="flex items-center justify-start">

        <a href="{{ route('expl') }}" class="flex items-center">
            <x-application-logo class="mr-3 block h-8 w-auto fill-current text-gray-800" />
            <span class="self-center text-xl font-bold tracking-tight sm:text-2xl whitespace-nowrap dark:text-white">Flashcards</span>
        </a>
        </div>

    <div class="flex items-center md:order-2">
      
      <div class="hidden md:block mr-6">
      <ul class="flex flex-col p-4 md:p-0 mt-4 md:flex-row md:space-x-4 md:mt-0 mr-4">
        @foreach(config('app.available_locales') as $locale)
        <li>
            <x-my-nav-link :href="route('lang', ['locale' => $locale])" :active="app()->getLocale() == $locale">
                {{ strtoupper($locale) }}
            </x-my-nav-link>
        </li>
        @endforeach
      </ul>
      </div>


      <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
          <span class="sr-only">Open user menu</span>
          <img class="w-8 h-8 rounded-full" src="{{auth()->user()->avatar}}" alt="">
      </button>

        <!-- Dropdown menu -->
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
          <div class="px-4 py-3">
            <span class="block text-sm text-gray-900 dark:text-white">{{auth()->user()->name}}</span>
            <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{auth()->user()->email}}</span>
          </div>
          <ul class="py-2" aria-labelledby="user-menu-button">
            <li>
              <a href="{{route('profile.edit')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">{{ __('Profile') }}</a>
            </li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
            </li>
          </ul>
        </div>


        <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
        </button>
    </div>

    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

        <li class="flex md:hidden">
          @foreach(config('app.available_locales') as $locale)
            <x-my-nav-link :href="route('lang', ['locale' => $locale])" :active="app()->getLocale() == $locale">
                {{ strtoupper($locale) }}
            </x-my-nav-link>
            @endforeach
        </li>
        <li>
            <x-my-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                {{ __('Users') }}
            </x-my-nav-link>
        </li>
        <li>
            <x-my-nav-link :href="route('admin.topics.index')" :active="request()->routeIs('admin.topics.*')">
                {{ __('Topics') }}
            </x-my-nav-link>
        </li>
        <li>
            <x-my-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                {{ __('Categories') }}
            </x-my-nav-link>
        </li>
      </ul>
    </div>

    </div>
  </nav>
  
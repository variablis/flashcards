
  <div class="hidden sm:flex sm:items-center ">
    <x-dropdown align="right" width="36">

        <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2  text-sm leading-4 font-medium rounded-md text-gray-400  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">

                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
         
            </button>
        </x-slot>

        <x-slot name="content">

            <x-dropdown-link :href="route('deck.create', $mydat)">
                {{ __('Add Deck') }}
            </x-dropdown-link>

            <x-dropdown-link :href="route('decks.edit', $mydat)">
                {{ __('Edit') }}
            </x-dropdown-link>

            <form method="POST" action="{{ route('decks.destroy', $mydat) }}">
                @csrf
                @method('DELETE')
                <x-dropdown-link :href="route('decks.destroy', $mydat)"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Delete') }}
                </x-dropdown-link>
            </form>
        </x-slot>

    </x-dropdown>
</div>
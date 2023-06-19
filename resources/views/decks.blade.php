<x-app-layout>

    <div class="flex">
        <div class="flex-initial w-32">
            @include('sidebar')
        </div>
        <div class="flex-1 w-80">


    {{-- <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-4xl font-bold">Create new deck</h2>
        <form method="POST" action="{{ route('decks.store') }}">
            @csrf

            <label for="aaa">Title label</label>
            <input id="aaa" 
            class="block w-80 p-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            name="title" text="{{ old('title') }}" placeholder="{{ __('pholdera teksts') }}" >
            <br>

            <label for="aaa">Descr label</label>
            <input id="aaa" 
            class="block w-80 p-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            name="description" text="{{ old('description') }}" placeholder="{{ __('d pholdera teksts') }}" >

            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
        </form>
    </div> --}}

    {{-- <x-primary-button class="mt-4">{{ __('New Topic') }}</x-primary-button> --}}

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <h2 class="text-xl font-bold">My decks</h2>


{{-- 
    <ul>
        @foreach ($xdecks as $d)
        <li> {{ $d->topic->title}} === {{ $d->title }} </li>
        @endforeach
    </ul> --}}

</div>


    
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        

        {{-- @foreach ($xdecks->groupBy('topic.title') as $topicTitle => $decks) --}}
        @foreach ($xdata as $da)
  

        <div class="bg-white shadow overflow-hidden sm:rounded-md max-w-sm mx-auto p-6">

            <div class="flex justify-between p-10">
                <p class="text-xl font-bold">{{ $da['topic']->title }}</p>

                {{-- <button class=" text-sm bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">{{ __('New Deck') }}</button> --}}

                <a href="{{ route('deck.create', $da['topic']->id ) }}" class="text-sm bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 ">{{ __('Add Deck') }}</a>

                {{-- <a href="{{ action([App\Http\Controllers\ManufacturerController::class, 'create'],['countryslug' => $country->code])}}">Add new manufacturer</a> --}}

            </div>

                {{-- <ul> --}}
                    @foreach ($da['decks'] as $d)
                    
                    {{-- <a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                            {{ $d->title }} - {{ $d->flashcards->count() }} cards</h5>

                            <a href="{{ route('decks.edit', $d->id) }}" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">{{ __('Edit') }}</a>

                            <form method="POST"
                                action="{{ route('decks.destroy', $d->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" type="submit" value="delete">{{ __('Delete') }}</button>
                            </form>

                    
                    </a> --}}

                   

                        {{-- <li>{{ $d->title }} - {{ $d->flashcards->count() }} cards -  --}}

             

                        {{-- </li> --}}
                       
                        <div class="flex justify-between  mb-4 max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                {{ $d->title }} - {{ $d->flashcards->count() }} cards
                            </h5>

                                <div class="hidden sm:flex sm:items-center ">
                                    <x-dropdown align="right" width="36">
                                        <x-slot name="trigger">
                                            <button class="inline-flex items-center px-3 py-2 border  text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                <div>Manage</div>
                    
                                                <div class="ml-1">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </x-slot>
                    
                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('decks.edit', $d->id)">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                    
                                            <form method="POST" action="{{ route('decks.destroy', $d->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <x-dropdown-link :href="route('decks.destroy', $d->id)"
                                                        onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </form>

                                        </x-slot>
                                    </x-dropdown>
                                </div>
                        </div>



                    
                      

                    @endforeach
                {{-- </ul> --}}



                <x-primary-button href="" class="mt-4">{{ __('Test knowledge') }}</x-primary-button>

                <a href="{{ route('decks.test', $da['topic']->id ) }}" class="text-sm bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 ">{{ __('Take Test') }}</a>

      


        </div>
        <br>
        @endforeach

    </div>



        </div>
    </div>

</x-app-layout>

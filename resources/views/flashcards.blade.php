<x-app-layout>

    @php
        $ex = (Str::is('expl.*', Route::currentRouteName() ))? 'expl.':'';
    @endphp

    @if(count($xfc))

    @include('sidebar', ['attributeName' => $xside, 'attr2' => $ex.'flashcards', 'sidename'=>__('Decks')])

    <div class="p-4 sm:ml-96">
    <div class="mt-14">

    <div class="max-w-5xl p-4 sm:p-6 lg:p-8">

        @if ($xowns)
        <div class="flex justify-between">
            <h2 class="text-xl font-bold">{{__('My flashcards')}}</h2>
            <a href="{{ route('deck.create') }}" class="text-grey shadow border border-gray-300 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{__('New deck')}}</a>
        </div>
        @else
        <h2 class="text-xl font-bold">{{__('Explore community flashcards')}}</h2>
        @endif

    </div>


    <div class="max-w-5xl p-4">

        @foreach ($xfc as $d)
        <div class="bg-white shadow sm:rounded-md p-6 mb-6">

            <div class="flex justify-between pb-4">
            
            <div>
                <h5 class="text-2xl font-bold text-gray-500">{{ $d->title }}</h5>
                <p class="pb-4 text-sm font-normal text-gray-400">{{ $d->description }}</p>
            </div>

            <div class="flex flex-row items-center">
                @can('is-owner', $d->topic)

                <a href="{{route('flashcards.create', $d->id)}}" class="text-gray-400 hover:text-gray-700 p-1.5">
                <svg class="w-6 h-6" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                    <path d="M12,24C5.4,24,0,18.6,0,12S5.4,0,12,0s12,5.4,12,12C24,18.6,18.6,24,12,24z M11.9,2.2c-5.4,0-9.6,4.4-9.6,9.7
                   s4.2,9.6,9.6,9.6s9.8-4.2,9.8-9.6S17.3,2.2,11.9,2.2L11.9,2.2z M16.8,13.2h-3.6v3.6c0,0.7-0.5,1.2-1.2,1.2h0c-0.7,0-1.2-0.5-1.2-1.2
                   v-3.6H7.2C6.5,13.2,6,12.7,6,12v0c0-0.7,0.5-1.2,1.2-1.2h3.6V7.2C10.8,6.5,11.3,6,12,6h0c0.7,0,1.2,0.5,1.2,1.2v3.6h3.6
                   c0.7,0,1.2,0.5,1.2,1.2v0C18,12.7,17.5,13.2,16.8,13.2z"/>
                </svg>
                </a>

                    @include('my.deck-dropdown', ['mydat'=>$d->id])
                @endcan

                @can('not-owner', $d->topic)
                <a href="{{ route('deck.copy', [$d->id, $d->topic->id] ) }}" class="text-sm bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 ">{{ __('Copy deck') }}</a>
                @endcan

            </div>
            </div>

            @if(count($d->flashcards))
            @foreach ($d->flashcards as $f)
                    <div class="mb-2 p-6 bg-white border border-gray-200 rounded-lg shadow-lg hover:bg-gray-100">

                    <div class="flex justify-between items-center">
                    <div>
                        <h5 class="mb-4 text-xl font-bold tracking-tight text-gray-900">Q: {{ $f->question }}</h5>
                        <p class="mb-4 text-md font-normal text-gray-700 dark:text-gray-400">A: {{ $f->answer }}</p>
                    </div>

                    @can('is-owner', $d->topic)
                        @include('my.flashcard-dropdown', ['mydat'=> $f->id])
                    @endcan
                    </div>


                    @can('is-owner', $d->topic)
                        <hr class="pt-2">
                        <div class="flex justify-between pt-4 text-xs text-gray-400">
                        Answered: {{ $f->times_answered}} Viewed: {{ $f->times_viewed }}
                        </div>
                    @endcan

                </div>
            @endforeach
            @else
            <div class="text-center text-gray-400">
                Deck has no flashcards.
            </div>
            @endif

        </div>
        @endforeach

    </div>
    </div>
    </div>

    @else
        @if ($xowns)
        <div class="pt-36 flex flex-col justify-center items-center">

            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{__('Welcome')}}!</h1>

            <p class="text-center text-gray-400 mb-10 max-w-md">
                To get started, create a topic and add decks to it. Once you've done that, you can begin adding flashcards to further enhance your learning experience.
            </p>
            
            <a href="{{ route('decks.index') }}" class="inline-flex items-center py-2.5 px-6 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__('My decks')}}
            </a>
        
        </div>
        @endif
    @endif

</x-app-layout>

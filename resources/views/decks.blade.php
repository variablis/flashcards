<x-app-layout>

    <div class="flex mx-auto max-w-7xl">
        <div class="flex-none w-80">
            @include('sidebar', ['attributeName' => $xside, 'attr2' => 'decks'])

        </div>
        <div class="flex-auto">

    <div class="max-w-4xl p-4 sm:p-6 lg:p-8">

        @if ($xowns)
        <h2 class="text-xl font-bold">My decks</h2>
        @else
        <h2 class="text-xl font-bold">Explore community decks</h2>
        @endif

    </div>
    
    <div class="max-w-4xl p-4">

        @foreach ($xtest as $da)

        <div class="bg-white shadow overflow-hidden sm:rounded-md p-6">

            <div class="flex justify-between pb-4">
                <h5 class="text-xl font-bold text-gray-400">{{ $da->title }}</h5>

                @can('is-owner', $da)
                owner, public: {{$da->is_public}}

                <a href="{{ route('deck.create', $da->id ) }}" class="text-sm bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 ">{{ __('Add Deck') }}</a>
                @endcan

                @can('not-owner', $da)
                <a href="{{ route('topic.copy', $da->id ) }}" class="text-sm bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 ">{{ __('Copy Topic') }}</a>
                @endcan
               
            </div>
             
             
                @foreach ($da->decks as $d)
                    
                    <div class="flex justify-between items-center mb-2 p-4 bg-white border border-gray-200 rounded-lg shadow-lg hover:bg-gray-100">
                        <div>
                            <a href="{{ route('flashcards.show', $d->id) }}" class=" text-lg font-bold tracking-tight text-gray-900">
                                {{ $d->title }} - {{ $d->flashcards->count() }} cards
                            </a>
                            <p class="text-sm text-gray-500">{{ $d->description }}</p>
                        </div>
                        <x-my-dropdown :mydat="$d->id" />
                    </div>

                @endforeach


            
            
            <div class="flex justify-between pt-4 text-sm  text-gray-500">
                <div>Flashcards to learn: {{ $da->flashcards_to_learn }} / {{ $da->flashcards_count }}
                    @if ( $da->flashcards_count > 0)
                    <div class="w-full bg-gray-200 rounded-full h-1.5 mb-4 dark:bg-gray-700">
                        <div class="bg-gray-400 h-1.5 rounded-full dark:bg-blue-500" style="width: {{ ($da->flashcards_count-$da->flashcards_to_learn)*100/$da->flashcards_count }}%"></div>
                    </div>
                    @endif
                </div>
                <x-my-link :href="route('decks.test', $da->id )">{{ __('Test knowledge') }}</x-my-link>
            </div>

        </div>
        <br>
        @endforeach

    </div>

        </div>
    </div>

</x-app-layout>

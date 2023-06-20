<x-app-layout>

    <div class="flex">
        <div class="flex-none w-80">
            @include('sidebar')
        </div>
        <div class="flex-auto">

    <div class="max-w-4xl p-4 sm:p-6 lg:p-8">
        <h2 class="text-xl font-bold">My flashcards</h2>
    </div>

    <div class="max-w-4xl p-4">

    @foreach ($xfc->groupBy('deck.title') as $deckTitle => $decks)
    <div class="bg-white shadow overflow-hidden sm:rounded-md p-6">


        <div class="flex justify-between pb-4">
            <h5 class="text-xl font-bold text-gray-400">{{ $deckTitle }}</h5>

            <a href="{{ route('flashcards.create', 0 ) }}" class="text-sm bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 ">{{ __('Add Flashcard') }}</a>
        </div>

        @foreach ($decks as $d)
        <a href="#" class="block mb-2 p-6 bg-white border border-gray-200 rounded-lg shadow-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Q: {{ $d->question }}</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">A: {{ $d->answer }}</p>
        </a>
        @endforeach


    </div>
    <br>
    @endforeach

    </div>


        </div>
    </div>

</x-app-layout>

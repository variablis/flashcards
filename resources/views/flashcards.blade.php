<x-app-layout>

    @include('sidebar', ['attributeName' => $xside, 'attr2' => 'flashcards'])

    <div class="p-4 sm:ml-96">
    <div class="mt-14">

    <div class="max-w-5xl p-4 sm:p-6 lg:p-8">

        @if ($xowns)
        <h2 class="text-xl font-bold">{{__('My flashcards')}}</h2>
        @else
        <h2 class="text-xl font-bold">{{__('Explore community flashcards')}}</h2>
        @endif

    </div>


    <div class="max-w-5xl p-4">

        @foreach ($xfc as $d)
        <div class="bg-white shadow sm:rounded-md p-6 mb-6 pt-10">

            <div class="flex justify-between pb-4">
            
            <div>
                <h5 class="text-2xl font-bold text-gray-400">{{ $d->title }}</h5>
                <p class="pb-4 text-sm font-normal text-gray-400">{{ $d->description }}</p>
            </div>

            <div class="flex flex-row h-9">
                @can('is-owner', $d->topic)
                    @include('my.deck-dropdown', ['mydat'=>$d->id])
                @endcan

                @can('not-owner', $d->topic)
                <a href="{{ route('deck.copy', $d->topic->id ) }}" class="text-sm bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 ">{{ __('Copy deck') }}</a>
                @endcan

            </div>
            </div>


            @foreach ($d->flashcards as $f)
                {{-- <div class="block mb-2 p-6 bg-white border border-gray-200 rounded-lg shadow-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"> --}}
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

        </div>
        @endforeach

    </div>
    </div>
    </div>

</x-app-layout>

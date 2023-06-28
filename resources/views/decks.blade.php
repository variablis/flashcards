<x-app-layout>

    @include('sidebar', ['attributeName' => $xside, 'attr2' => 'decks'])

    <div class="p-4 sm:ml-96">
        <div class="mt-14">

    <div class="max-w-5xl p-4 sm:p-6 lg:p-8">

        @if ($xowns)
        <h2 class="text-xl font-bold">{{__('My Decks')}}</h2>
        @else
        <h2 class="text-xl font-bold">{{__('Explore community decks')}}</h2>
        @endif

    </div>
    
    <div class="max-w-5xl p-4">

        @foreach ($xtest as $topic)

        <div class="bg-white shadow sm:rounded-md p-6 mb-6">

            <div class="flex justify-between pb-4">

            <div>
                <h5 class=" text-2xl font-bold text-gray-500">{{ $topic->title }}</h5>
                <p class="pb-4 text-sm font-normal text-gray-400">{{ $topic->description }}</p>
            </div>

            <div class="flex flex-row h-9">
                @can('is-owner', $topic)                

                <div class="flex items-center px-6">  
                    <span class="mx-2 text-sm font-medium text-gray-500 dark:text-gray-300">Public</span>
                        
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="{{$topic->id}}" class="public_sw sr-only peer" @if ($topic->is_public) checked @endif>
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>
                
                <x-my-topic-dropdown :mydat="$topic->id" />
                
                @endcan

                @can('not-owner', $topic)
                <a href="{{ route('topic.copy', $topic->id ) }}" class="text-sm bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 ">{{ __('Copy Topic') }}</a>
                @endcan

            </div>
        </div>
             
             
            @foreach ($topic->decks as $d)
                
                <div class="flex justify-between items-center mb-2 p-4 bg-white border border-gray-200 rounded-lg shadow-lg hover:bg-gray-100">
                    <div>
                        <a href="{{ route('flashcards.show', $d->id) }}" class=" text-lg font-bold tracking-tight text-gray-900">
                            {{ $d->title }} - {{ $d->flashcards->count() }} cards
                        </a>
                        <p class="text-sm text-gray-500">{{ $d->description }}</p>
                    </div>
                    <x-my-deck-dropdown :mydat="$d->id" />
                </div>

            @endforeach


            @if($topic->decks->count()===0)
            <div class="text-center text-gray-400">
                Topic has no decks.
            </div>
            @else
                @can('is-owner', $topic)
                <div class="flex justify-between pt-4 text-sm  text-gray-500">
                    <div>Flashcards to learn: {{ $topic->flashcards_to_learn }} / {{ $topic->flashcards_count }}
                        @if ( $topic->flashcards_count > 0)
                        <div class="w-full bg-gray-200 rounded-full h-1.5 mb-4 dark:bg-gray-700">
                            <div class="bg-gray-400 h-1.5 rounded-full dark:bg-blue-500" style="width: {{ ($topic->flashcards_count-$topic->flashcards_to_learn)*100/$topic->flashcards_count }}%"></div>
                        </div>
                        @endif
                    </div>
                    <x-my-link :href="route('decks.test', $topic->id )">{{ __('Test knowledge') }}</x-my-link>
                </div>
                @endcan
            @endif

        </div>
        @endforeach

    </div>

        </div>
    </div>

    <script>
        // Get all checkboxes on the page
        const checkboxes = document.querySelectorAll('input[type="checkbox"].public_sw');

        // Attach change event listener to each checkbox
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', (event) => {
                // Log the changed value to the console
                
                console.log(`Checkbox value changed: ${event.target.value} ${event.target.checked}`);
            });
        });
    </script>

</x-app-layout>

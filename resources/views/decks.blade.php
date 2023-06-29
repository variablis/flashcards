<x-app-layout>

    @include('sidebar', ['attributeName' => $xside, 'attr2' => 'decks'])

    <div class="p-4 sm:ml-96">
    <div class="mt-14">

    <div class="max-w-5xl p-4 sm:p-6 lg:p-8">

        @if ($xowns)
        <div class="flex justify-between">
        <h2 class="text-xl font-bold">{{__('My decks')}}</h2>
        <a href="{{ route('topics.create') }}" class="text-grey shadow border border-gray-300 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            {{__('New topic')}}</a>
        </div>
        @else
        <h2 class="text-xl font-bold">{{__('Explore community decks')}}</h2>
        @endif

    </div>

    
    <div class="max-w-5xl p-4">

        @foreach ($xtest as $topic)
        <div class="bg-white shadow sm:rounded-md p-6 mb-6 pt-10">

            <div class="flex justify-between pb-4">

            <div>
                <h5 class=" text-2xl font-bold text-gray-500">{{ $topic->title }}</h5>
                <p class="pb-4 text-sm font-normal text-gray-400">{{ $topic->description }}</p>
            </div>

            <div class="flex flex-row h-9">
                @can('is-owner', $topic)                

                <div class="flex items-center px-6">  
                    <span class="mx-2 text-sm font-medium text-gray-500 dark:text-gray-300">{{__('Public')}}</span>
                        
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="{{$topic->id}}" class="public_sw sr-only peer" @if ($topic->is_public) checked @endif>
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>
                
                @include('my.topic-dropdown', ['mydat'=>$topic->id])
                
                @endcan

                @can('not-owner', $topic)
                <a href="{{ route('topic.copy', $topic->id ) }}" class="text-sm bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 ">{{ __('Copy topic') }}</a>
                @endcan

            </div>
            </div>
             
             
            @foreach ($topic->decks as $de)
                
                <div class="flex justify-between items-center mb-2 p-4 bg-white border border-gray-200 rounded-lg shadow-lg hover:bg-gray-100">
                    <div>
                        <a href="{{ route('flashcards.show', $de->id) }}" class=" text-lg font-bold tracking-tight text-gray-900">
                            {{ $de->title }} - {{ $de->flashcards->count() }} cards
                        </a>
                        <p class="text-sm text-gray-500">{{ $de->description }}</p>
                    </div>

                    @can('is-owner', $topic) 
                        @include('my.deck-dropdown', ['mydat' => $de->id])
                    @endcan

                    @can('not-owner', $topic)
                        {{-- <a href="{{ route('deck.copy', $d->id ) }}" class="text-sm bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 ">{{ __('Copy deck') }}</a> --}}
                        

                        {{-- @include('my.copy-deck-dropdown', ['mydat' => $de->id]); --}}

                        <div class="hidden sm:flex sm:items-center ">
                            <x-dropdown align="right" width="96">
                        
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2  text-sm leading-4 font-medium rounded-md text-gray-400  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                                    </button>
                                </x-slot>
    
                                <x-slot name="content">

                                    <p class="p-4 text-sm font-medium">Choose a topic to copy the deck to</p>
                                    <hr>

                                    @foreach ( auth()->user()->topics as $t )
                                    <x-dropdown-link :href="route('deck.copy', ['id' => $de->id, 'tid' => $t->id] )">
                                        {{$t->title}}
                                    </x-dropdown-link>
                                    @endforeach
 
                                </x-slot>
                        
                            </x-dropdown>
                        </div>

                    @endcan

                </div>

            @endforeach


            @if($topic->decks->count()===0)
            <div class="text-center text-gray-400">
                Topic has no decks.
            </div>
            @else
                @can('is-owner', $topic)
                <div class="flex justify-between pt-4 text-sm text-gray-400">
                    <div>Flashcards to learn: {{ $topic->flashcards_to_learn }} / {{ $topic->flashcards_count }}
                        @if ( $topic->flashcards_count > 0)
                        <div class="w-full bg-gray-200 rounded-full h-1.5 mb-4 dark:bg-gray-700">
                            <div class="bg-green-400 h-1.5 rounded-full dark:bg-blue-500" style="width: {{ ($topic->flashcards_count-$topic->flashcards_to_learn)*100/$topic->flashcards_count }}%"></div>
                        </div>
                        @endif
                    </div>
                    <x-my-link :href="route('topic.test', $topic->id )">{{ __('Test knowledge') }}</x-my-link>
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
        const token = document.querySelector('meta[name="csrf-token"]').content;
        var mydata = @json($xtest);

        function saveToggle(id, chk){

            var fdata = mydata.find(function(el) {
                return el.id === parseInt(id);
            });

            // console.log(fdata, parseInt(id));

            var url = "{{ route('topics.update', ':id') }}";
            url = url.replace(':id', id);

            fetch(url, {
                method: "put",
                headers: {
                    "Content-type": "application/json; charset=UTF-8",
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    title: fdata.title,
                    description: fdata.description,
                    category_id: fdata.category_id,
                    is_public: chk? 1:0
                }),
            });
        }

        // Attach change event listener to each checkbox
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', (event) => {
                saveToggle(event.target.value, event.target.checked);
                // console.log(`Checkbox value changed: ${event.target.value} ${event.target.checked}`);
            });
        });
    </script>

</x-app-layout>

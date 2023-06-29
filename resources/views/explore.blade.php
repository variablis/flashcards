<x-app-layout>
<div class="mx-auto max-w-7xl p-4 pt-24">
    <div class="mb-8">

    <h1 class="text-center mt-8 mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{__('Explore and start learning!')}}</h1>
    <p class="text-center mx-auto mb-10 text-lg font-normal text-gray-500 lg:text-xl max-w-3xl dark:text-gray-400">{{__('Flashcard learning enhances memory retention through active recall, enabling users to reinforce understanding and recall key information more effectively.')}}</p>

    <form class="flex items-center max-w-xl mx-auto">   
        <label for="main-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" name="search" id="main-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{__('Search a topic you want to learn...')}}" required>
        </div>
        <button type="submit" class="inline-flex items-center py-2.5 px-6 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg aria-hidden="true" class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>{{__('Search')}}
        </button>
    </form>

       @if($srch)
            <div class="text-center p-4 text-sm text-gray-500 ">
            {{$cnt}} results for: {{$srch}}
            </div>
       @endif

    </div>
    <hr class="mb-8">


@if($xcat->isNotEmpty())

    @if($srch)
    @foreach ($xcat as $categoryId => $categoryDecks)
        <h2 class="mb-4 text-2xl">{{ $categoryDecks->first()->first()->topic->category->name }}</h2>

        @foreach ($categoryDecks as $topicId => $topicDecks)

            
            <div class="mb-4 bg-white shadow sm:rounded-md p-6">
                <div class="flex justify-between mb-4">
                    <a href="{{ route('decks.show', $topicDecks->first()->topic->id ) }}">
                        <div>
                            <p class="text-xl font-bold">{{ $topicDecks->first()->topic->title }}</p>
                            <p class="text-md">{{ $topicDecks->first()->topic->description }}</p>
                        </div>
                    </a>
                    <div>
                        {{ $topicDecks->first()->topic->user->name }} 
                        pub: {{ $topicDecks->first()->topic->is_public }}
                    </div>

                </div>
                @foreach ($topicDecks as $deck)
                    <div class="mb-2 bg-white shadow-lg border border-gray-200 overflow-hidden sm:rounded-md p-6">
                        <a href="{{ route('flashcards.show', $topicDecks->first()->id ) }}">
                            <p class="text-xl font-bold">{{ $deck->title }}</p>
                            <p>{{ $deck->description }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
         
        @endforeach
    @endforeach

    @else
    {{-- not search --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach ($xcat as $categoryId => $categoryDecks)
    <div class="pb-4">
        <h2 class="mb-4 font-bold text-2xl">{{ __($categoryDecks->first()->first()->topic->category->name) }}

            <span class="inline-flex items-center bg-green-200 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                {{$categoryDecks->first()->first()->topic->category->publicTopics->count()}}
                {{ __('Topics', ['count' => 10]) }}
            </span>
        </h2>

   
        <ul class="mb-4">
        @foreach ($categoryDecks as $topicId => $topicDecks)
            <li>
                <a class="text-md pb-1 block hover:underline text-gray-500" href="{{ route('decks.show', $topicDecks->first()->topic->id ) }}">
                    {{ $topicDecks->first()->topic->title }}
                </a>
            </li>
        @endforeach
        </ul>

        @if ($categoryDecks->first()->first()->topic->category->publicTopics->count()>5)
            <a class="text-gray-900 border border-gray-300 focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-200 font-medium rounded-md text-sm px-2 py-1 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" href="{{ route('topics.indexCategory', $categoryId) }}">{{ __('Show all') }}...</a>
        @endif
    </div>
    @endforeach
    </div>

    @endif

@else

Nothing found...
@endif
  


</div>

</x-app-layout>
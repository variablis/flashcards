<x-app-layout>

<div class="mx-auto max-w-7xl p-4">
       <h2 class="text-4xl pb-6">Explore</h2>
       <p class="pb-6">Flashcard learning enhances memory retention through active recall, enabling users to reinforce understanding and recall key information more effectively. Its portability and adaptability make it a versatile tool for personalized and convenient studying, allowing users to optimize their learning experience.
       </p>

       <form action="/">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="search" name="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for Topics, Decks and Flashcards..." required>
            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__('Search')}}</button>
        </div>
    </form>

       @if($srch)
       <div class="p-4">
       Search results for: {{$srch}}
        </div>
       @endif

@if($xcat->isNotEmpty())

    @foreach ($xcat as $categoryId => $categoryDecks)

        <h2 class="text-2xl">Category: {{ $categoryDecks->first()->first()->topic->category->name }}</h2>

        @foreach ($categoryDecks as $topicId => $topicDecks)
        <div class="bg-white shadow overflow-hidden sm:rounded-md p-6">
            <a class="text-2xl font-bold" href="{{ route('decks.show', $topicDecks->first()->topic->id ) }}">
                {{ $topicDecks->first()->topic->title }}: {{ $topicDecks->first()->topic->user->name }} 
                - {{ $topicDecks->first()->topic->is_public }}
            </a>
            
        @if($srch)
            @foreach ($topicDecks as $deck)
                <div class="bg-white shadow overflow-hidden sm:rounded-md p-6">
                    <a href="{{ route('flashcards.show', $topicDecks->first()->id ) }}">
                        <p class="text-xl font-bold">{{ $deck->title }}</p>
                        <p>{{ $deck->description }}</p>
                    </a>
                </div><br>
            @endforeach
        @endif
            </div>
            <br>
            
        @endforeach
        
        <br>

    @endforeach

@else

Nothing found...
@endif
  


</div>

</x-app-layout>
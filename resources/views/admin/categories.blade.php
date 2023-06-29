<x-app-layout>
    <div class="mx-auto max-w-4xl pt-24">
    
        <div class="text-sm flex justify-between items-center shadow border rounded border-gray-300 mb-1 p-4">
        <p>Topics: <span class="font-bold mr-4">{{$stats->topics_sum}}</span>
        Decks: <span class="font-bold mr-4">{{$stats->decks_sum}}</span>
        Flashcards: <span class="font-bold">{{$stats->fc_sum}}</span></p>

        <a href="{{ route('categories.create') }}" class="text-grey shadow border border-gray-300 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-4 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            {{__('New category')}}
        </a>
        </div>

    <ul class="mb-4">
        @foreach ( $cat as $c )
            <li>
                <div class="text-sm flex justify-between mb-1 bg-white shadow rounded p-3">
                    <p class="font-bold">{{$c->name}}
                    <span class="text-sm font-normal text-gray-500">- {{$c->topics_cnt}} topics,  {{$c->decks_cnt}} decks, {{$c->fc_cnt}} cards</span>
                    </p>
                    <div class="flex justify-between w-24">
                    <a href="{{route('categories.edit', $c)}}">
                        {{__('Edit')}}
                    </a>

                    <form action="{{ route('categories.destroy', $c) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit">{{__('Delete')}}</button>
                    </form>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    </div>

</x-app-layout>

<x-app-layout>
    <div class="mx-auto max-w-4xl pt-24">

    <ul class="mb-4">
        @foreach ( $users as $u )
            <li>
                <div class="text-sm flex justify-between mb-1 bg-white shadow rounded p-3">

                    <p class="font-bold">
                        <img class="inline-flex w-4 h-4 rounded-full mr-2" src="{{$u->avatar}}" alt="">
                        <a href="{{route('admin.topics.indexUser', $u)}}">{{$u->name}}</a>
                        <span class="font-normal text-gray-500">- {{$u->email}},  {{$u->topicCount}} topics, {{$u->deckCount}} decks, {{$u->flashcardCount }} cards</span>

                        @if($u->banned)
                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{__('Banned')}}</span>
                        @endif
                        
                    </p>

                    @unless ($u->is_admin && $u->id===1)
                    <div class="flex justify-between w-24">
                    <a href="{{route('users.edit', $u)}}">
                        {{__('Edit')}}
                    </a>

                    <form action="{{ route('users.destroy', $u) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit">{{__('Delete')}}</button>
                    </form>

                    </div>
                    @endunless 

                </div>
            </li>
        @endforeach
    </ul>

    {{ $users->links() }}

    </div>
</x-app-layout>

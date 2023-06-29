<x-app-layout>
    <div class="mx-auto max-w-4xl pt-24">

        @if ($topics->count())
        <div id="accordion-collapse" data-accordion="collapse">
        @foreach ( $topics as $t )
            
        <div class="flex items-center justify-between bg-white mb-1 shadow rounded p-3 text-sm">

            <p><span class="font-bold">{{$t->title}}</span> - <a href="{{route('admin.topics.indexUser', $t->user)}}">{{$t->user->name}}</a></p>
            
            <div class="flex items-center justify-between w-24">
            <form action="{{ route('admin.topics.destroy', $t) }}" method="POST">
                @csrf
                @method("DELETE")
                <button type="submit">{{__('Delete')}}</button>
            </form>

            <h2 id="accordion-collapse-heading-{{$t->id}}">
            <button type="button" class="flex items-center justify-between font-medium border bg-white border-gray-200 rounded shadow focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-collapse-body-{{$t->id}}" aria-controls="accordion-collapse-body-{{$t->id}}">
                
                <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            </h2>

            </div>

        </div>

            <div id="accordion-collapse-body-{{$t->id}}" class="text-sm hidden bg-white p-6 mb-1" aria-labelledby="accordion-collapse-heading-{{$t->id}}">
                <ul>
                    @foreach ( $t->decks as $d )
                    <li>
                        <div class="text-sm flex justify-between mb-1 bg-white shadow rounded p-3 border">
                            <a href="">{{$d->title}}</a>

                            <form action="{{ route('admin.decks.destroy', $d) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit">{{__('Delete')}}</button>
                            </form>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        
        @endforeach
        </div>

    {{ $topics->links() }}
    @else
        {{__('Nothing to show')}}...
    @endif
    </div>
</x-app-layout>

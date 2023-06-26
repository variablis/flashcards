<x-app-layout>

    <div class="mx-auto max-w-7xl p-4">

        <div class="pb-4">
            <h2 class="mb-4 text-2xl font-bold">{{ $xtopics->first()->category->name }}</h2>
            @foreach ($xtopics as $t)
            <a class="text-lg block hover:underline" href="{{ route('decks.show', $t->id ) }}">
                {{ $t->title }}
            </a>
            @endforeach

            {{ $xtopics->links() }}
        </div>

    </div>

</x-app-layout>

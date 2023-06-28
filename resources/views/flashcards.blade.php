{{-- @auth --}}
<x-app-layout>

    {{-- <div class="flex mx-auto max-w-7xl">

        <div class="flex-none w-80">
            @include('sidebar', ['attributeName' => $xside, 'attr2' => 'flashcards'])
        </div>

        <div class="flex-auto"> --}}

    @include('sidebar', ['attributeName' => $xside, 'attr2' => 'flashcards'])

    <div class="p-4 sm:ml-96">
    <div class="mt-14">

        <div class="max-w-5xl p-4 sm:p-6 lg:p-8">
            {{-- <h2 class="text-xl font-bold">My flashcards</h2> --}}
            @if ($xowns)
            <h2 class="text-xl font-bold">My flashcards</h2>
            @else
            <h2 class="text-xl font-bold">Explore community flashcards</h2>
            @endif
        </div>

        <div class="max-w-5xl p-4">

    
    @foreach ($xfc as $d)
    <div class="bg-white shadow sm:rounded-md p-6">
        <div class="flex justify-between pb-4">
            <h5 class="text-xl font-bold text-gray-400">{{ $d->title }}</h5>
            <a href="{{ route('flashcard.create', $d->id ) }}" class="text-sm bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 ">{{ __('Add Flashcard') }}</a>
        </div>

    @foreach ($d->flashcards as $x)
        <a href="#" class="block mb-2 p-6 bg-white border border-gray-200 rounded-lg shadow-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Q: {{ $x->question }}</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">A: {{ $x->answer }}</p>
        </a>
    @endforeach

    </div>
    <br>
    @endforeach

    </div>
    </div>
    </div>

</x-app-layout>
{{-- @endauth --}}


    {{-- @foreach ($xfc as $d)
    <div class="bg-white shadow overflow-hidden sm:rounded-md p-6">
        <div class="flex justify-between pb-4">
            <h5 class="text-xl font-bold text-gray-400">{{ $d->title }}</h5>
            
        </div>

    @foreach ($d->flashcards as $x)
        <a href="#" class="block mb-2 p-6 bg-white border border-gray-200 rounded-lg shadow-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Q: {{ $x->question }}</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">A: {{ $x->answer }}</p>
        </a>
    @endforeach

    </div>
    <br>
    @endforeach --}}
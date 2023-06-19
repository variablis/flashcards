<x-app-layout>

    <div class="flex">
        <div class="flex-initial w-32">
            @include('sidebar')
        </div>
        <div class="flex-1 w-80">



    {{-- <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-4xl font-bold">Create new flashcard</h2>
        <form method="POST" action="{{ route('topics.store') }}">
            @csrf

            <label for="aaa">Q label</label>
            <input id="aaa" 
            class="block w-80 p-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            name="title" text="{{ old('title') }}" placeholder="{{ __('pholdera teksts') }}" >
            <br>

            <label for="aaa">A label</label>
            <input id="aaa" 
            class="block w-80 p-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            name="description" text="{{ old('description') }}" placeholder="{{ __('d pholdera teksts') }}" >
            

            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
        </form>
    </div> --}}

    {{-- <x-primary-button class="mt-4">{{ __('New Deck') }}</x-primary-button> --}}

    {{-- <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <h2 class="text-4xl font-bold">My Flashcards list</h2>
    <ul>
        @foreach ($xfc as $f)
        <li> Q: {{ $f->question }} - A: {{ $f->answer }}</li>
        @endforeach
    </ul>
    </div> --}}

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-xl font-bold">My flashcards</h2>
    </div>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

    @foreach ($xfc->groupBy('deck.title') as $deckTitle => $decks)
    <div class="bg-white shadow overflow-hidden sm:rounded-md max-w-sm mx-auto p-6">
        <p class="text-xl font-bold">{{ $deckTitle }}</p>
        <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">{{ __('Add flashcard') }}</button>

        
{{-- <div class="relative overflow-x-auto ">
    <table class="w-full text-left ">
       
        <tbody>

            @foreach ($decks as $d)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                <td class="px-4 py-4">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Question</label>
                <textarea id="message" rows="1" class="block p-2.5 w-full  text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here...">{{ $d->question }}</textarea>
                
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Answer</label>
                <textarea id="message" rows="1" class="block p-2.5 w-full  text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here...">{{ $d->answer }}</textarea>
                </td>

                <td class="px-4 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Save</a>
                </td>

                <td class="px-4 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div> --}}

@foreach ($decks as $d)
<a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Q: {{ $d->question }}</h5>
    <p class="font-normal text-gray-700 dark:text-gray-400">A: {{ $d->answer }}</p>
</a>
@endforeach


        {{-- <ul class="block w-full">
            @foreach ($decks as $d)
            <li class="block w-full">
                
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Question</label>
                <textarea id="message" rows="2" class="block p-2.5 w-full  text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here...">{{ $d->question }}</textarea>

                <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Answer</label>
                <textarea id="message" rows="2" class="block p-2.5 w-full  text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here...">{{ $d->answer }}</textarea>


                <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">{{ __('Edit') }}
                </button>

                <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">{{ __('Delete') }}
                </button>

                </li>
            @endforeach
        </ul> --}}

  

    </div>
    <br>
    @endforeach

    </div>



        </div>
    </div>

</x-app-layout>

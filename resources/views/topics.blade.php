<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-4xl font-bold">Create new topic</h2>
        <form method="POST" action="{{ route('topics.store') }}">
            @csrf

            <label for="aaa">Title label</label>
            <input id="aaa" 
            class="block w-80 p-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            name="title" text="{{ old('title') }}" placeholder="{{ __('pholdera teksts') }}" >
            <br>

            <label for="aaa">Descr label</label>
            <input id="aaa" 
            class="block w-80 p-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            name="description" text="{{ old('description') }}" placeholder="{{ __('d pholdera teksts') }}" >

            <select name="user">
                @foreach($cc as $user)
                 <option value="{{ $user->name}}">{{ $user->name}}</option>
                @endforeach
            </select>
            

            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
        </form>
    </div>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <h2 class="text-4xl font-bold">My topics list</h2>
    <ul>
        @foreach ($xtopics as $t)
        <li>{{ $t->user->name }} - {{ $t->title }} - {{ $t->category->name}} </li>
        @endforeach
    </ul>
    </div>

</x-app-layout>

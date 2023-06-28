<x-app-layout>

    <div class="pt-24">
    <div class=" mx-auto md:w-1/2 bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-lg font-bold mb-4">{{ __('Edit deck')}}</h1>

    <form method="POST" action={{ route('decks.update', $deck) }}>
        @csrf
        @method('put')

        {{-- <label for='d_title'>Title</label><br>
        <input type="text" name="d_title" id="d_title" 
        value="{{ old('d_title', $deck->title) }}"><br>

        <label for='d_description'>Descr</label><br>
        <input type="text" name="d_description" id="d_description" 
        value="{{ old('d_description', $deck->description) }}"><br> --}}

        <div>
            <x-input-label for="dck_title" :value="__('Title')" />
            <x-text-input id="dck_title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $deck->title)" required autofocus />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="dck_description" :value="__('Description')" />
            <x-text-input id="dck_description" class="block mt-1 w-full" type="text" name="description" :value="old('description', $deck->description)" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div class="mt-4 mb-8">
            <x-input-label for="usr_topics" :value="__('Topic')" />
            <select name="topic_id" id="usr_topics" class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">{{__('Choose a topic')}}</option>
            @foreach ($topics as $t)
                <option value="{{$t->id}}" @if($t->id == $deck->topic->id) selected @endif>{{$t->title}}</option>
            @endforeach
            </select>
            <x-input-error :messages="$errors->get('topic_id')" class="mt-2" />
        </div>
        

        <x-primary-button>{{__('Update')}}</x-primary-button>
    </form>

    </div>
    </div>

</x-app-layout>

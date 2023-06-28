<x-app-layout>

    <div class="pt-24">
    <div class=" mx-auto md:w-1/2 bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-lg font-bold mb-4">{{ $t->title }}: {{ __('New deck')}}</h1>

    <form method="POST" action={{ route('decks.store') }}>
        @csrf

        <input type="hidden" name="topic_id" value={{ $t->id }}>

        <div>
            <x-input-label for="dck_title" :value="__('Title')" />
            <x-text-input id="dck_title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="mt-4 mb-8">
            <x-input-label for="dck_description" :value="__('Description')" />
            <x-text-input id="dck_description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <x-primary-button>{{__('Save')}}</x-primary-button>
    </form>

    </div>
    </div>

</x-app-layout>

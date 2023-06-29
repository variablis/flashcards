<x-app-layout>

    <div class="pt-24">
    <div class=" mx-auto md:w-1/2 bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-lg font-bold mb-4">{{ __('New category')}}</h1>

    <form method="POST" action={{ route('categories.store') }}>
        @csrf

        <div class="mt-4 mb-8">
            <x-input-label for="cat_name" :value="__('Name')" />
            <x-text-input id="cat_name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <x-primary-button>{{__('Save')}}</x-primary-button>
    </form>

    </div>
    </div>

</x-app-layout>

<x-app-layout>

    <div class="pt-24">
    <div class=" mx-auto md:w-1/2 bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-lg font-bold mb-4">{{ __('Edit user')}}</h1>

    <form method="POST" action={{ route('users.update', $usr) }}>
        @csrf
        @method('put')

        <div class="mt-4">
            <x-input-label for="usr_name" :value="__('Name')" />
            <x-text-input id="usr_name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $usr->name)" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="usr_email" :value="__('Email')" />
            <x-text-input id="usr_email" class="block mt-1 w-full" type="text" name="email" :value="old('email', $usr->email)" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label class="relative inline-flex items-center cursor-pointer">
                <input name="is_admin" type="checkbox" value="1" {{ old('is_admin', $usr->is_admin) == '1' ? 'checked' : '' }} class="sr-only peer" >
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Admin')}}</span>
            </label>
        </div>

        <div class="mt-4 mb-8">
            <label class="relative inline-flex items-center cursor-pointer">
                <input name="is_banned" type="checkbox" value="1" {{ old('is_banned', $usr->is_banned) == '1' ? 'checked' : '' }} class="sr-only peer" >
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Banned')}}</span>
            </label>
        </div>

        <x-primary-button>{{__('Save')}}</x-primary-button>
    </form>

    </div>
    </div>

</x-app-layout>

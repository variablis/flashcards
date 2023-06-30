<x-app-layout>

    <div class="pt-24">
    <div class=" mx-auto md:w-1/2 bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-lg font-bold mb-4">{{ __('Edit topic')}}</h1>

    <form method="POST" action={{ route('topics.update', $topic) }}>
        @csrf
        @method('put')

        <div>
            <x-input-label for="tpc_title" :value="__('Title')" />
            <x-text-input id="tpc_title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $topic->title)" required autofocus />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="tpc_description" :value="__('Description')" />
            <x-text-input id="tpc_description" class="block mt-1 w-full" type="text" name="description" :value="old('description', $topic->description)" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="tpc_category" :value="__('Category')" />
            <select name="category_id" id="tpc_category" class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">{{__('Choose a category')}}</option>
            @foreach ($cat as $c)
                <option value="{{$c->id}}" @if($c->id == $topic->category->id) selected @endif>{{$c->name}}</option>
            @endforeach
            </select>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>
        
        <div class="mt-4 mb-8">
            <label class="relative inline-flex items-center cursor-pointer">
                <input name="is_public" type="checkbox" value="1" {{ old('is_public', $topic->is_public) == '1' ? 'checked' : '' }} class="sr-only peer" >
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Public visibility')}}</span>
            </label>
        </div>

        {{-- <button type="submit" value="Update">Update</button> --}}
        <x-primary-button>{{__('Update')}}</x-primary-button>
    </form>

    </div>
    </div>

</x-app-layout>

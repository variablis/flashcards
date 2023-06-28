<x-app-layout>

    <div class="pt-24">
    <div class=" mx-auto md:w-1/2 bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-lg font-bold mb-4">{{ __('Edit topic')}}</h1>

    <form method="POST"
        action={{ route('topics.update', [ 'topic' => $topic]) }}>
        @csrf
        @method('put')

        <label for='d_title'>Title</label><br>
        <input type="text" name="d_title" id="d_title" 
        value="{{ old('d_title', $topic->title) }}"><br>

        <label for='d_description'>Descr</label><br>
        <input type="text" name="d_description" id="d_description" 
        value="{{ old('d_description', $topic->description) }}"><br>
        
        {{-- <button type="submit" value="Update">Update</button> --}}
        <x-primary-button>{{__('Save')}}</x-primary-button>
    </form>

    </div>
    </div>

</x-app-layout>

<x-app-layout>

    <div class="pt-24">
    <div class=" mx-auto md:w-1/2 bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-lg font-bold mb-4">{{ $tpc->title }}: {{ __('New deck')}}</h1>

    <form method="POST" action={{ route('decks.store') }}>
        @csrf
        <input type="hidden" name="tpc_id" value={{ $tpc->id }}>
        <label for='dck_title'>{{__('Title')}}</label><br>
        <input type="text" name="dck_title" id="dck_title" value={{ old('dck_title') }}><br>

        <label for='dck_description'>{{__('Description')}}</label><br>
        <input type="text" name="dck_description" id="dck_description" value={{ old('dck_description') }}><br>

        <x-primary-button>{{__('Save')}}</x-primary-button>
    </form>

    </div>
    </div>

</x-app-layout>

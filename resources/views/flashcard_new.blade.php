<x-app-layout>

    <div class="pt-24">
    <div class=" mx-auto md:w-1/2 bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-lg font-bold mb-4">{{ $dck->title }}: {{ __('New flashcard')}}</h1>


    <form method="POST" action={{ route('flashcards.store') }}>
        @csrf
        
        <input type="hidden" name="dck_id" value="{{ $dck->id }}">

        <label for='fc_question'>question</label><br>
        <input type="text" name="fc_question" id="fc_question" value="{{ old('fc_question') }}"><br>

        <label for='fc_answer'>answer</label><br>
        <input type="text" name="fc_answer" id="fc_answer" value="{{ old('fc_answer') }}"><br>

        <x-primary-button>{{__('Save')}}</x-primary-button>
    </form>

    </div>
    </div>


</x-app-layout>

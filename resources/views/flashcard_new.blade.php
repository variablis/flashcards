<x-app-layout>

    <h1>New flashcard</h1>


    <form method="POST" action={{ action([App\Http\Controllers\FlashcardController::class, 'store']) }}>
        @csrf
        <input type="hidden" name="dck_id" value="{{ $dck->id }}">

        <label for='fc_question'>question</label><br>
        <input type="text" name="fc_question" id="fc_question" value="{{ old('fc_question') }}"><br>

        <label for='fc_answer'>answer</label><br>
        <input type="text" name="fc_answer" id="fc_answer" value="{{ old('fc_answer') }}"><br>

        <button type="submit" value="Add">Save</button>
    </form>


</x-app-layout>

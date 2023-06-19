<x-app-layout>

    <h1>New deck</h1>


    <form method="POST" action={{ action([App\Http\Controllers\DeckController::class, 'store']) }}>
        @csrf
        <input type="hidden" name="tpc_id" value="{{ $tpc->id }}">
        <label for='dck_title'>Deck title</label><br>
        <input type="text" name="dck_title" id="dck_title" value="{{ old('dck_title') }}"><br>

        <label for='dck_description'>Deck description</label><br>
        <input type="text" name="dck_description" id="dck_description" value="{{ old('dck_description') }}"><br>

        <button type="submit" value="Add">Save</button>
    </form>


</x-app-layout>

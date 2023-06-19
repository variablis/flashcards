<x-app-layout>

    <h1>Editing deck</h1>

    <form method="POST"
        action={{ action([App\Http\Controllers\DeckController::class, 'update'], [ 'deck' => $deck]) }}>
        @csrf
        @method('put')

        <label for='d_title'>Title</label><br>
        <input type="text" name="d_title" id="d_title" 
        value="{{ old('d_title', $deck->title) }}"><br>

        <label for='d_description'>Descr</label><br>
        <input type="text" name="d_description" id="d_description" 
        value="{{ old('d_description', $deck->description) }}"><br>
        
        <button type="submit" value="Update">Update</button>
    </form>

</x-app-layout>

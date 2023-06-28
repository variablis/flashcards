<x-app-layout>

    <ul class="pt-24">
@foreach ( $users as $u )
    <li>{{$u->name}} {{$u->email}} - {{$u->topicCount}} - {{$u->deckCount }} - {{$u->flashcardCount }} == {{$u->banned}}</li>
@endforeach
    </ul>

</x-app-layout>

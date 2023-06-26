<x-app-layout>

    <ul class="pt-24">
@foreach ( $users as $x )
    <li>{{$x->name}} {{$x->email}} - {{$x->topicCount}} - {{$x->deckCount }} - {{$x->flashcardCount }}</li>
@endforeach
    </ul>

</x-app-layout>

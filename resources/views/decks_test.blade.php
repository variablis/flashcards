<x-app-layout>


    @foreach ($xdata as $f)
        <div>Q: {{$f->question}} </div>
        <div>A: {{$f->answer}} </div>
        <br>
    @endforeach

  

</x-app-layout>

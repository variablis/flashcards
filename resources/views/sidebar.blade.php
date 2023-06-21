
<div class=" p-4 sm:p-6 lg:p-8">

    <x-primary-button class="mt-4">{{ __('+ New topic') }}</x-primary-button>

    <ul class="bg-white shadow overflow-hidden sm:rounded-md ">

        <li class="border-t border-gray-200 p-4">
            <a href="{{ route($attr2.'.index') }}" class="text-lg leading-6 font-medium text-gray-900">All</a>
        </li>

        @foreach ($attributeName as $t)
        <li class="border-t border-gray-200 p-4">
            <a href="{{ route($attr2.'.show', $t->id ) }}" class="text-lg leading-6 font-medium text-gray-900">{{ $t->title }}</a>
        </li>
        @endforeach
    </ul>

</div>
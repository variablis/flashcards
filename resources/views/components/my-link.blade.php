@props(['color' => 'blue'])

<a {{ $attributes->merge(['class' => 'text-white bg-gradient-to-r from-'.$color.'-500 via-'.$color.'-600 to-'.$color.'-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-'.$color.'-300 dark:focus:ring-'.$color.'-800 shadow-md shadow-'.$color.'-500/50 dark:shadow-md dark:shadow-'.$color.'-700/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2']) }}>{{ $slot }}</a>

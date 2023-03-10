@props(['active' => false])

@php
    $classes = 'block text-left px-3 mt-2 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white';
    if ($active) $classes .= 'block text-left px-3 mt-2 text-sm leading-6 bg-blue-500 text-white';
    //$classes = ($active ?? false) ? 'bg-blue-500 text-white' : 'text-blue-500 hover:bg-blue-500 hover:text-white';
@endphp

<a {{ $attributes(['class' => $classes]) }}
>{{ $slot }}</a>

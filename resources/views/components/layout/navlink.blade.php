{{-- @props(['active']) --}}

@php
$classes = ($active ?? false)
? 'nav-link p-3 active'
: 'nav-link p-3 link-dark';
@endphp

<a href="{{$href}}" {{ $attributes->merge(['class' => $classes]) }} @if($active) aria-current="true" @endif>
    {{$slot}}
</a>
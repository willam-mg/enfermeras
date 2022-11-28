{{-- @props(['active']) --}}

@php
$classes = ($active ?? false)
? 'nav-link active'
: 'nav-link';
@endphp

<a href="{{$href}}" {{ $attributes->merge(['class' => $classes]) }} @if($active) aria-current="true" @endif>
    {{$slot}}
</a>
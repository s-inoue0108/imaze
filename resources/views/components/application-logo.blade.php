@props(['width'])

<img {{ $attributes->merge(['width' => $width.'%']) }} src="{{ asset('/storage/logo/iMAZE-logo2.png') }}" />

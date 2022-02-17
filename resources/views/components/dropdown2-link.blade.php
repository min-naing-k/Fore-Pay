@props(['active' => false])

@php
$active_link = $active ? 'bg-indigo-500 text-white' : 'hover:bg-gray-100';
@endphp

<a @click="open = false"
  {{ $attributes->merge(['class' => "cursor-pointer block px-4 py-2 text-sm text-gray-700 $active_link"]) }}>
  {{ $slot }}
</a>

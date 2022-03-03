@props(['active' => false, 'tag' => 'a'])

@php
$active_link = $active ? 'bg-indigo-500 text-white' : 'hover:bg-gray-100';
@endphp

<{{ $tag }} @click="open = false"
  {{ $attributes->merge(['class' => "cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 $active_link"]) }}>
  {{ $slot }}
</{{ $tag }}>

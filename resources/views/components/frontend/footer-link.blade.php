@props(['active' => false])

@php
$active_link = $active ? 'text-theme' : 'text-gray-300';
@endphp

<a {{ $attributes->merge(['class' => "hover:text-theme cursor-pointer px-4 flex items-center h-full rounded-xl $active_link transition ease-in-out duration-150"]) }}>
  {{ $slot }}
</a>

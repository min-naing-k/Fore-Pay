@props(['active' => false])

@php
$main_class = 'group hover:text-sky-400 whitespace-nowrap cursor-pointer flex items-center font-semibold text-sm transition ease-linear duration-150';
$icon_class = 'group-hover:bg-sky-400 group-hover:text-slate-100 flex items-center p-2 mr-3 rounded-md transition ease-linear duration-150';
$main_class .= $active ? ' text-sky-400' : ' text-slate-400';
$icon_class .= $active ? ' text-slate-100 bg-sky-400' : ' text-slate-400 bg-slate-800';
@endphp

<a {{ $attributes->merge(['class' => $main_class]) }}>
  <div
    {{ $attributes->merge(['class' => $icon_class]) }}>
    {{ $icon }}
  </div>
  {{ $slot }}
</a>

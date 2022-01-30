@props(['active' => false])

@php
$main_class = 'group hover:text-sky-400 cursor-pointer flex items-center text-slate-400 font-semibold text-sm transition ease-linear duration-150';
$icon_class = 'group-hover:bg-sky-400 group-hover:text-slate-100 flex items-center text-slate-400 bg-slate-800 p-2 mr-3 rounded-md transition ease-linear duration-150';
if ($active) {
    $main_class = 'group hover:text-sky-400 flex items-center text-sky-400 font-semibold text-sm transition ease-linear duration-150';
    $icon_class = 'group-hover:bg-sky-400 group-hover:text-slate-100 flex items-center text-slate-100 bg-sky-400 p-2 mr-3 rounded-md transition ease-linear duration-150';
}
@endphp

<a {{ $attributes->merge(['class' => $main_class]) }}>
  <div
    {{ $attributes->merge(['class' => $icon_class]) }}>
    {{ $icon }}
  </div>
  {{ $slot }}
</a>

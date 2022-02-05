<div {{ $attributes->merge(['class' =>'search focus-within:ring-2 ring-indigo-500 ring-offset-2 flex border border-gray-200 rounded-lg overflow-hidden']) }}>
  <label class="flex items-center pl-3" for="search">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>
  </label>
  <input type="text" id="search" class="focus:ring-0 placeholder:text-gray-400 w-full border-none pl-1" placeholder="Search..." autocomplete="off">
</div>

<!-- Navbar Start -->
<nav class="bg-white shadow-sm">
  <div class="relative max-w-7xl mx-auto flex items-center justify-between h-16 px-3 md:px-4">
    <!-- Mobile Menu Icon -->
    <div class="mobile-menu cursor-pointer text-gray-600">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
      </svg>
    </div>
    <!-- Search -->
    <div class="search focus-within:ring-2 ring-indigo-500 ring-offset-2 flex border border-gray-200 rounded-lg overflow-hidden">
      <label class="flex items-center pl-3" for="search">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </label>
      <input type="search" id="search" class="focus:ring-0 placeholder:text-gray-400 w-full border-none pl-1" placeholder="Search..." autocomplete="off">
    </div>
    <div class="flex items-center">
      <button type="button" class="p-1 rounded-full text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-500 focus:ring-white">
        <!-- Heroicon name: outline/bell -->
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
      </button>

      <!-- Profile dropdown -->
      <x-dropdown2 class="ml-0 md:ml-3">
        <x-slot name="trigger">
          <button type="button"
            class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
            <img class="h-8 w-8 min-w-max rounded-full"
              src="https://ui-avatars.com/api/?size=35&background=random&name={{ auth()->guard('admin')->user()->name }}" alt="">
          </button>
        </x-slot>
        <div class="px-4 py-2 flex flex-col border-b border-b-gray-200">
          <p class="font-medium text-gray-500">{{ ucwords(auth()->guard('admin')->user()->name) }}</p>
          <small class="text-gray-400">{{ auth()->guard('admin')->user()->email }}</small>
        </div>
        <x-dropdown2-link href="#">Your Profile</x-dropdown2-link>
        <x-dropdown2-link href="#">Setting</x-dropdown2-link>
        <x-dropdown2-link href="#" class="sign-out-btn">Sign Out</x-dropdown2-link>
      </x-dropdown2>
    </div>
  </div>
</nav><!-- Navbar End -->

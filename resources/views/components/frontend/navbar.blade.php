{{-- Navbar --}}
<nav class="bg-white shadow-sm">
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <div class="flex-1 flex items-center justify-start sm:items-stretch sm:justify-start">
        <div class="flex items-center text-xl font-sans font-bold text-gray-600">
          <a href="/">Fore Pay</a>
        </div>
        <div class="hidden sm:block sm:ml-6">
          <div class="flex space-x-4 h-16">
            <x-frontend.nav-link href="/" :active="request()->is('/')">Home</x-frontend.nav-link>
            <x-frontend.nav-link href="#">Wallet</x-frontend.nav-link>
            <x-frontend.nav-link href="{{ route('transactions.index') }}" :active="request()->routeIs('transactions.index')">Transition</x-frontend.nav-link>
            <x-frontend.nav-link href="{{ route('profile') }}" :active="request()->is('profile*')">Profile</x-frontend.nav-link>
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <button type="button" class="p-1 mr-2 rounded-full text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-500 focus:ring-white">
          <!-- Heroicon name: outline/bell -->
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
        </button>

        <!-- Profile dropdown -->
        <x-dropdown2>
          <x-slot name="trigger">
            <button type="button"
              class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
              id="user-menu-button"
              aria-expanded="false" aria-haspopup="true">
              <span class="sr-only">Open user menu</span>
              @if (auth()->user()->image)
                <img src="{{ auth()->user()->profileImage() }}" class="w-8 h-8 rounded-full object-cover" style="width: 35px;height: 35px;"
                  alt="{{ auth()->user()->name }}">
              @else
                <img class="w-8 h-8 object-cover rounded-full"
                  src="https://ui-avatars.com/api/?format=svg&rounded=true&size=35&name={{ auth()->user()->name }}" alt="{{ auth()->user()->name }}">
              @endif
            </button>
          </x-slot>
          <div class="px-4 py-2 flex flex-col border-b border-b-gray-200">
            <p class="font-medium text-gray-500 leading-5">
              {{ auth()->user()->name }}
              <small class="block text-gray-400">{{ auth()->user()->email }}</small>
            </p>
          </div>
          <x-dropdown2-link href="{{ route('profile') }}" :active="request()->routeIs('profile')">Your Profile</x-dropdown2-link>
          <x-dropdown2-link href="#">Setting</x-dropdown2-link>
          <x-dropdown2-link href="#" class="sign-out-btn">Log Out</x-dropdown2-link>
        </x-dropdown2>
      </div>
    </div>
  </div>
</nav>

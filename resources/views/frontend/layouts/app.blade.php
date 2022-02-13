<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  {{-- Fontawesome --}}
  <script src="https://kit.fontawesome.com/e4fdbc0c51.js" crossorigin="anonymous"></script>

  {{-- Tailwind Css --}}
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  {{-- <script src="https://cdn.tailwindcss.com"></script> --}}


  {{-- custom css --}}
  <link rel="stylesheet" href="{{ asset('css/frontend/style.css') }}">

  {{ $css ?? null }}
</head>

<body class="bg-gray-100">
  {{-- Navbar --}}
  <nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->
          <button type="button"
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
            aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <!--
            Icon when menu is closed.

            Heroicon name: outline/menu

            Menu open: "hidden", Menu closed: "block"
          -->
            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <!--
            Icon when menu is open.

            Heroicon name: outline/x

            Menu open: "block", Menu closed: "hidden"
          -->
            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex items-center text-xl font-bold text-gray-500">
            <a href="/">Magic Pay</a>
          </div>
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4 h-16">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <a href="#" class="h-full flex items-center text-gray-700 px-3 py-2 text-sm font-medium nav-link active">Home</a>

              <a href="#" class="h-full flex items-center text-gray-400 px-3 py-2 text-sm font-medium">Team</a>

              <a href="#" class="h-full flex items-center text-gray-400 px-3 py-2 text-sm font-medium">Projects</a>

              <a href="#" class="h-full flex items-center text-gray-400 px-3 py-2 text-sm font-medium">Calendar</a>
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
                    src="https://ui-avatars.com/api/?format=svg&rounded=true&size=35&name={{ auth()->user()->name }}" alt="{{ auth()->guard('admin')->user()->name }}">
                @endif
              </button>
            </x-slot>
            <div class="px-4 py-2 flex flex-col border-b border-b-gray-200">
              <p class="font-medium text-gray-500">{{ auth()->user()->name }}</p>
              <small class="text-gray-400">{{ auth()->user()->email }}</small>
            </div>
            <x-dropdown2-link href="#">Your Profile</x-dropdown2-link>
            <x-dropdown2-link href="#">Setting</x-dropdown2-link>
            <x-dropdown2-link href="#" class="sign-out-btn">Sign Out</x-dropdown2-link>
          </x-dropdown2>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <a href="#" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Dashboard</a>

        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Team</a>

        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Projects</a>

        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Calendar</a>
      </div>
    </div>
  </nav>

  {{-- Main Content --}}
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 mt-4">
    <div class="px-2 sm:px-6 lg:px-8 mt-4 py-4 bg-white rounded-md">
      {{ $main }}
    </div>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>

  {{-- Custom Js --}}
  <script>
    const sign_out_btn = document.querySelector('.sign-out-btn');

    sign_out_btn.addEventListener('click', e => {
      e.preventDefault();
      axios({
          method: 'POST',
          url: '/logout',
        }).then(res => {
          if (res.data) {
            window.location.replace('/login');
          }
        })
        .catch(err => console.error(err));
    })
  </script>

  {{ $js ?? null }}
</body>

</html>

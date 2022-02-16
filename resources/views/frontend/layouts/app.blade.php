<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ $title ?? 'Fore Pay' }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <!-- Custom Css -->
  <link rel="stylesheet" href="{{ asset('css/frontend/style.css') }}">

  {{ $css ?? null }}
</head>

<body class="bg-gray-100">
  <!-- Navbar -->
  <x-frontend.navbar />

  <!-- Main -->
  <main class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 mt-4">
    {{ $slot }}
  </main>

  <!-- Footer -->
  <x-frontend.footer />

  <script src="{{ asset('js/app.js') }}"></script>

  <!-- Custom Js -->
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

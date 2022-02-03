<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>


  <!-- Select2 Css -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- Custom Css -->
  <link rel="stylesheet" href="{{ asset('css/backend/style.css') }}">

  {{ $css ?? null }}
</head>

<body>
  <!-- Over view -->
  <div class="over-view"></div>

  <x-backend.sidebar />

  <!-- Main Start -->
  <main class="main min-h-screen overflow-hidden">
    <x-backend.navbar />

    <section class="max-w-7xl mx-auto p-3 md:p-4">
      <!-- Main Content Header -->
      <header class="flex items-center mb-4">
        <div class="mr-5 bg-white text-gray-300 p-4 rounded-lg m-shadow">
          {{ $icon ?? null }}
        </div>
        <h1 class="text-gray-500 text-xl font-semibold">{{ $title }}</h1>
      </header>

      <!-- Main Content Start -->
      <div class="rounded-lg overflow-hidden m-shadow">
        {{ $slot }}
      </div>
    </section>
  </main><!-- Main Content End -->

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/jquery.js') }}"></script>
  <!-- Select 2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    const body = document.querySelector('body');
    const over_view = document.querySelector('.over-view');
    const sidebar = document.querySelector('.side-bar');
    const cross = document.querySelector('.cross');
    const mobile_menu = document.querySelector('.mobile-menu');
    const sign_out_btn = document.querySelector('.sign-out-btn');

    $(document).ready(function() {
      $('.single-select').select2({
        minimumResultsForSearch: -1
      });
    });

    window.addEventListener('load', e => {
      const window_width = this.innerWidth;
      if (window_width > 768) return;
      sidebar.style.transition = 'none !important';
      sidebar.classList.remove('active');
    })

    window.addEventListener('resize', e => {
      const window_width = this.innerWidth;
      if (window_width > 768) return;
      sidebar.classList.remove('active');
    })

    sign_out_btn.addEventListener('click', e => {
      e.preventDefault();
      axios({
        method: 'POST',
        url: '/admin/logout',
      }).then(res => {
        if (!res.data) return;
        console.log(res.data);
        this.location.replace('/admin/login');
      }).catch(err => console.error(err));
    })

    sidebar.addEventListener('mouseenter', e => {
      const window_width = this.innerWidth;
      if (window_width < 768) return;

      if (!e.target.classList.contains('active')) {
        e.target.classList.add('active');
      }
    })

    cross.addEventListener('click', e => {
      if (sidebar.classList.contains('active') || sidebar.classList.contains('mobile-active')) {
        sidebar.classList.remove('active');
        sidebar.classList.remove('mobile-active');
        body.classList.remove('active');
      }
    })

    mobile_menu.addEventListener('click', e => {
      if (!sidebar.classList.contains('mobile-active')) {
        sidebar.classList.add('mobile-active');
        body.classList.add('active');
      }
    })

    over_view.addEventListener('click', e => {
      const window_width = this.innerWidth;
      if (window_width > 768) return;

      if (sidebar.classList.contains('mobile-active')) {
        sidebar.classList.remove('mobile-active');
        body.classList.remove('active');
      }
    })
  </script>
  {{ $js ?? null }}
</body>

</html>

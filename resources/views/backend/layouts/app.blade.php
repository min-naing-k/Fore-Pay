<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>


  <!-- Select2 Css -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Flowbite Tailwind Css Component -->
  <link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.2/dist/flowbite.min.css" />

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
        <div class="mr-5 bg-white text-gray-300 w-11 h-11 flex items-center justify-center rounded-lg m-shadow">
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

  <!-- Flowbite Tailwind Css Component -->
  <script src="https://unpkg.com/flowbite@1.3.2/dist/flowbite.js"></script>

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/jquery.js') }}"></script>

  <!-- Select 2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- Sweet Alert 2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    const body = document.querySelector('body');
    const over_view = document.querySelector('.over-view');
    const sidebar = document.querySelector('.side-bar');
    const cross = document.querySelector('.cross');
    const mobile_menu = document.querySelector('.mobile-menu');
    const sign_out_btn = document.querySelector('.sign-out-btn');
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      customClass: {
        timerProgressBar: 'success-progress-bar'
      },
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    @if (session('create'))
      Toast.fire({
      icon: 'success',
      title: '{{ session('create') }}',
      customClass: {
      timerProgressBar: 'success-progress'
      }
      })
    @endif

    @if (session('update'))
      Toast.fire({
      icon: 'success',
      title: '{{ session('update') }}',
      customClass: {
      timerProgressBar: 'success-progress'
      }
      })
    @endif

    @if (session('warning'))
      Toast.fire({
      icon: 'warning',
      title: '{{ session('warning') }}',
      customClass: {
      timerProgressBar: 'warning-progress'
      }
      })
    @endif

    @if (session('error'))
      Toast.fire({
      icon: 'error',
      title: '{{ session('error') }}',
      customClass: {
      timerProgressBar: 'error-progress'
      }
      })
    @endif

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
        method: 'GET',
        url: '/admin/logout',
      }).then(res => {
        if (!res.data) return;
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

    const debounce = (fn, delay) => {
      let id;
      return () => {
        if (id) clearTimeout(id);
        id = setTimeout(() => {
          fn();
        }, delay);
      }
    }
  </script>
  {{ $js ?? null }}
</body>

</html>

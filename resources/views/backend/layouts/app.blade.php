<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <style>
    body {
      background-color: #f2f2f2;
    }

    .m-shadow {
      box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .mobile-menu {
      display: none;
    }

    .side-bar {
      width: 57px;
      transition: width .3s ease-in-out;
    }

    .side-bar .cross {
      top: 12px;
    }

    .side-bar .logo {
      white-space: nowrap;
    }

    .side-bar .logo,
    .side-bar .cross {
      opacity: 0;
      visibility: hidden;
      transition: all .6s ease-in-out;
    }

    .side-bar .title {
      display: none;
    }

    .side-bar .divider {
      width: 100%;
      left: -2px;
    }

    .side-bar.active {
      transition: width .3s ease-in-out;
      width: 256px;
    }

    .side-bar.active .logo,
    .side-bar.active .cross,
    .side-bar.active .side-bar-title {
      opacity: 1;
      visibility: visible;
    }

    .over-view {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, .1);
      backdrop-filter: blur(2px);
      z-index: 10;
      opacity: 0;
      visibility: hidden;
      user-select: none;
      pointer-events: none;
      transition: all .4s ease-in-out;
    }

    @media (max-width: 768px) {
      .side-bar {
        z-index: 1000 !important;
        position: fixed;
        width: 45% !important;
        transform: translateX(-100%);
        transition: all .4s ease-in-out;
      }

      .side-bar .title {
        display: block;
      }

      .side-bar.mobile-active {
        transition: all .4s ease-in-out;
        transform: translateX(0);
      }

      body.active .over-view {
        opacity: 1;
        visibility: visible;
        pointer-events: all;
      }

      .side-bar .logo,
      .side-bar .cross {
        opacity: 1;
        visibility: visible;
      }

      .search {
        display: none;
      }

      .mobile-menu {
        display: block;
      }
    }

    @media (max-width: 500px) {
      .side-bar {
        width: 65% !important;
      }
    }

    @media (max-width: 430px) {
      .side-bar {
        width: 85% !important;
      }
    }

  </style>
  {{ $css ?? null }}
</head>

<body class="overflow-hidden">
  <!-- Over view -->
  <div class="over-view"></div>
  <div class="min-h-screen flex">
    <x-sidebar />

    <!-- Main Start -->
    <div class="flex-1">
      <x-navbar />

      <div class="max-w-7xl mx-auto">
        <!-- Main Content Header -->
        <div class="flex items-center m-3 md:m-4">
          <div class="mr-5 bg-white text-gray-300 p-4 rounded-lg m-shadow">
            {{ $icon ?? null }}
          </div>
          <h1 class="text-gray-500 text-xl font-semibold">{{ $title }}</h1>
        </div>

        <!-- Main Content Start -->
        <div class="bg-white m-3 p-4 md:m-4 h-52 rounded-lg overflow-hidden m-shadow">
          {{ $slot }}
        </div>
      </div>
    </div><!-- Main Content End -->
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
  <script>
    const body = document.querySelector('body');
    const over_view = document.querySelector('.over-view');
    const sidebar = document.querySelector('.side-bar');
    const cross = document.querySelector('.cross');
    const mobile_menu = document.querySelector('.mobile-menu');
    const sign_out_btn = document.querySelector('.sign-out-btn');

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

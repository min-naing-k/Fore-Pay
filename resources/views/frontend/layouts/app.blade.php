<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ $title ?? 'Fore Pay' }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Select2 Css -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Image Viewer -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.4/viewer.min.css"
    integrity="sha512-OgbWuZ8OyVQxlWHea0T9Bdy1oDhs380WxLMaLZbuitQ/mdntHBPnApxbTebB9N5KoHZd3VMkk3G2cTY563nu5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Flowbite Tailwind Css Component -->
  <link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.2/dist/flowbite.min.css" />

  <!-- Daterangepicker js css -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <!-- Custom Css -->
  <link rel="stylesheet" href="{{ asset('css/frontend/style.css') }}">

  {{ $css ?? null }}
</head>

<body class="bg-gray-100 font-open-sans">
  <!-- Navbar -->
  <x-frontend.navbar />

  <!-- Main -->
  <main>
    {{ $slot }}
  </main>

  <!-- Footer -->
  <x-frontend.footer />

  <!-- Flowbite Tailwind Css Component -->
  <script src="https://unpkg.com/flowbite@1.3.2/dist/flowbite.js"></script>

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/jquery.js') }}"></script>

  <!-- Sweet Alert 2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Image Viewer -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.4/viewer.min.js"></script>

  <!-- Select 2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- Moment Js -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

  <!-- Daterangepicker Js -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  <!-- Custom Js -->
  <script>
    const sign_out_btn = document.querySelector('.sign-out-btn');
    const log_out_btn = document.querySelector('.log-out-btn');
    const sweet_alert_settings = {
      showCancelButton: true,
      reverseButtons: true,
      focusConfirm: false,
      confirmButtonText: 'Ok',
      customClass: {}
    }
    const sweet_alert_delete_settings = {
      ...sweet_alert_settings,
      title: `Are you sure to?`,
      text: "Once you delete this record, you will not get back!",
      confirmButtonText: "Delete",
      customClass: {
        confirmButton: "swal2-delete-btn",
      },
    };
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
    });

    $(document).ready(function() {
      $('.single-select').select2({
        minimumResultsForSearch: -1,
        width: 'resolve'
      });

      $('.single-date-picker').daterangepicker({
        singleDatePicker: true,
        autoApply: true,
        opens: "center",
        showDropdowns: true,
        locale: {
          "format": "YYYY-MM-DD",
        }
      });

      $('.range-date-picker').daterangepicker({
        autoApply: true,
        opens: "center",
        showDropdowns: true,
        startDate: moment().subtract(1, 'month'),
        endDate: moment(),
        locale: {
          "format": "YYYY/MM/DD",
        }
      });
    });

    const debounce = (fn, delay) => {
      let id;
      return (...args) => {
        if (id) clearTimeout(id);
        id = setTimeout(() => {
          fn(...args);
        }, delay);
      }
    }

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

    @if (session('success'))
      Toast.fire({
      icon: 'success',
      title: '{{ session('success') }}',
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

    if (log_out_btn) {
      log_out_btn.addEventListener('click', e => {
        e.preventDefault();
        sweet_alert_settings.title = `Are you sure to logout?`;
        sweet_alert_settings.confirmButtonText = 'Confirm';
        sweet_alert_settings.customClass.confirmButton = 'swal2-confirm-btn';
        Swal.fire(sweet_alert_settings).then(result => {
          if (result.isConfirmed) {
            axios({
                method: 'POST',
                url: '/logout',
              }).then(res => {
                if (res.data) {
                  window.location.replace('/login');
                }
              })
              .catch(err => console.error(err));
          }
        });
      })
    }
  </script>

  {{ $js ?? null }}
</body>

</html>

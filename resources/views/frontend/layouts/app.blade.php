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
  <main>
    {{ $slot }}
  </main>

  <!-- Footer -->
  <x-frontend.footer />

  <script src="{{ asset('js/app.js') }}"></script>

  <!-- Sweet Alert 2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

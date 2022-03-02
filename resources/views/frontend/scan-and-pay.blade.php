<x-app title="Scan And Pay">
  <x-frontend.container>
    <x-card>
      <div class="relative">
        <a href="{{ route('home') }}" class="profile-icon absolute">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
          </svg>
        </a>

        <img src="{{ asset('images/qr-scanner.png') }}" alt="qr-scanner" class="mx-auto" style="width: 150px;height: 150px;" />

        <p class="text-sm text-gray-500 text-center my-3">Please click the scan button and pay without knowing phone number quickly.</p>
      </div>
      <x-modal id="scan-modal">
        <x-slot name="trigger">
          <div class="text-center">
            <button class="btn-primary" id="scan-btn">Scan</button>
          </div>
        </x-slot>

        <div>
          <h1 class="font-semibold">Scan And Pay</h1>
        </div>
        <div>
          <video id="scan-video" class="mt-4 rounded-md"></video>
        </div>
      </x-modal>
    </x-card>
  </x-frontend.container>
  <form action="{{ route('scan-and-pay.redirect-to-transfer') }}" method="POST" id="scan-form" style="display: none">
    @csrf
    <input type="hidden" name="phone" id="phone" />
  </form>

  <x-slot name="js">
    <script src="{{ asset('js/qr-scanner.umd.min.js') }}"></script>
    <script>
      const scan_btn = document.querySelector('#scan-btn');
      const cancel_btn = document.querySelector('#cancel-btn');
      const scan_modal = document.querySelector('#scan-modal');
      const scan_video = document.querySelector('#scan-video');
      const scan_form = document.querySelector('#scan-form');

      const qrScanner = new QrScanner(scan_video, result => {
        if (result) {
          const phone = result;
          qrScanner.stop();
          scan_modal.style.display = "none";
          scan_form.querySelector('#phone').value = phone;
          scan_form.submit();
        }
      });

      scan_btn.addEventListener('click', e => {
        qrScanner.start();
      });

      scan_modal.addEventListener('click', e => {
        if (e.target.id == 'scan-modal') {
          qrScanner.stop();
        }
      });

      cancel_btn.addEventListener('click', e => {
        qrScanner.stop();
      });
    </script>
  </x-slot>
</x-app>

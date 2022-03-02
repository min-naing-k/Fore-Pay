<x-app title="Qr Code">
  <x-frontend.container>
    <x-card class="flex flex-col mx-auto" style="max-width: 320px;min-height: 440px">
      <div class="flex items-center justify-center bg-theme w-full rounded-lg" style="height: 280px">
        @php
          $qr = base64_encode(
              QrCode::format('png')
                  ->style('round')
                  ->size(130)
                  ->backgroundColor(74, 71, 255)
                  ->generate($phone),
          );
        @endphp
        <img src="data:image/png;base64, {!! $qr !!} " />
      </div>
      <div class="flex flex-col flex-1 justify-center items-center">
        <p class="text-lg text-center font-bold">{{ $user_name }}</p>
        <p class="text-sm text-center text-gray-500 mb-4">{{ $phone }}</p>
        <p class="text-sm text-center text-gray-500">You can give me money via scanning my qr code.Thanks a lot.🧡🧡🧡</p>
      </div>
    </x-card>
  </x-frontend.container>
</x-app>

<x-app title="Success Transaction">
  <x-frontend.container>
    <x-card>
      <section class="flex flex-col items-center justify-center gap-y-3">
        <div class="text-green-500 w-16 h-16 overflow-hidden rounded-full">
          <img src="{{ asset('images/checked.png') }}" alt="transaction successful"
            class="w-full h-full rounded-full object-cover object-center" />
        </div>
        <p class="text-green-500 font-medium">Payment Successful</p>
      </section>

      <section class="flex flex-col items-center justify-center mt-6">
        <p class="text-gray-700">
          Transfer To <span class="font-semibold">{{ $receive_user }}</span>
        </p>
        <p class="text-gray-800 text-xl font-bold">
          {{ number_format($amount, 2) }} <small class="text-xs">MMK</small>
        </p>
      </section>

      <section class="flex items-center justify-center mt-6">
        <a href="{{ route('home') }}" class="btn-primary">Back To Home</a>
      </section>
    </x-card>
  </x-frontend.container>
</x-app>

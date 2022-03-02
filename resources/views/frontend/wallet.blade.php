<x-app title="Wallet">
  <x-frontend.container class="mb-20">
    {{-- Card Section --}}
    <section>
      <x-card class="wallet bg-theme m-shadow-lg" style="height: 120px">
        <div class="flex justify-between h-full items-start">
          <div class="flex flex-col h-full justify-between">
            <div>
              <h1 class="text-gray-300 font-medium text-sm">{{ $account_number }}</h1>
              <p class="text-gray-300 font-medium text-sm">{{ $user_name }}</p>
            </div>
            <p class="text-white font-medium text-xl">{{ number_format($amount, 2) }} MMK</p>
          </div>
          <div class="w-10 h-10 overflow-hidden">
            <img src="{{ asset('images/card.png') }}" alt="card" class="w-full h-full object-cover" />
          </div>
        </div>
      </x-card>
    </section>
    {{-- Recent Activity Section --}}
    <section class="mt-4">
      <h1 class="font-medium mb-2">Recent</h1>
      <x-card>
        <div>
          @foreach ($transactions as $transaction)
            <a href="{{ route('transactions.show', $transaction->trx_id) }}"
              class="flex justify-between border-b border-b-gray-200 last-of-type:border-b-0 last-of-type:pb-0 items-center {{ $loop->first ? 'pt-0 pb-4' : 'py-4' }}">
              <div>
                <p class="text-xs text-gray-500">
                  {{ $transaction->type == 1 ? 'Receive From' : 'Transfer To' }} {{ $transaction->source ? $transaction->source->name : '-' }}
                </p>
                <p class="text-xs text-gray-500">{{ $transaction->created_at }}</p>
              </div>
              <p class="text-gray-700 font-semibold text-sm">
                {{ $transaction->type == 1 ? '+' : '-' }}{{ number_format($transaction->amount, 2) }}MMK
              </p>
            </a>
          @endforeach
        </div>
      </x-card>
    </section>
  </x-frontend.container>
</x-app>

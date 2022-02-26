<x-app title="Transaction Details">
  <x-frontend.container>
    <x-card class="relative">
      <a href="{{ route('transactions.index') }}" class="profile-icon" style="position: absolute">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
        </svg>
      </a>
      {{-- Icon Section --}}
      <section class="flex flex-col items-center justify-center gap-y-3 border-b border-b-gray-200 pb-4">
        <div class="text-green-500 w-16 h-16 overflow-hidden rounded-full">
          <img src="{{ asset('images/checked.png') }}" alt="transaction successful"
            class="w-full h-full rounded-full object-cover object-center" />
        </div>
        <p class="text-green-500 font-medium">Payment Successful</p>
      </section>
      {{-- Detail Section --}}
      <section class="pt-4 text-sm space-y-3">
        <div class="flex items-center justify-between">
          <h5 class="text-gray-500">Transaction ID</h5>
          <p class="font-semibold">{{ $transaction->trx_id }}</p>
        </div>
        <div class="flex items-center justify-between">
          <h5 class="text-gray-500">Reference Number</h5>
          <p class="font-semibold">{{ $transaction->ref_no }}</p>
        </div>
        <div class="flex items-center justify-between">
          <h5 class="text-gray-500">Transaction Time</h5>
          <p class="font-semibold">{{ $transaction->created_at }}</p>
        </div>
        <div class="flex items-center justify-between">
          <h5 class="text-gray-500">{{ $transaction->type === 1 ? 'Receive From' : 'Transfer To' }}</h5>
          <p class="font-semibold">{{ $transaction->source ? $transaction->source->name : '-' }}</p>
        </div>
        <div class="flex items-center justify-between">
          <h5 class="text-gray-500">Type</h5>
          {!! $transaction->type == 1 ? '<p class="badge-success">Income</p>' : '<p class="badge-danger">Expense</p>' !!}
        </div>
        @if ($transaction->description)
          <div class="flex items-center justify-between">
            <h5 class="text-gray-500">Description</h5>
            <p class="font-semibold">{{ $transaction->description }}</p>
          </div>
        @endif
        <div class="flex items-center justify-between">
          <h5 class="text-gray-500">Amount</h5>
          <p class="font-semibold">{{ $transaction->type === 1 ? '+' : '-' }}{{ number_format($transaction->amount, 2) }} MMK</p>
        </div>
      </section>
    </x-card>
  </x-frontend.container>
</x-app>

<x-app title="Home">
  <x-frontend.container>
    <section>
      <x-card class="bg-theme relative flex flex-col justify-center overflow-hidden" style="height: 120px">
        <img src="{{ asset('images/money.png') }}" alt="money" class="absolute money-image">
        <span class="text-lightblue text-xs mb-2">Total Balance</span>
        <h1 class="text-white text-2xl font-semibold relative flex flex-wrap items-end gap-1 leading-5" style="max-width: 185px">
          {{ auth()->user()->wallet ? number_format(auth()->user()->wallet->amount, 2) : '0' }} <small class="text-xs leading-3">MMK</small>
        </h1>
      </x-card>
    </section>
    <section class="flex flex-wrap gap-3 mt-4">
      <x-card class="flex flex-1 flex-col items-center justify-center">
        <a href="{{ route('transfer') }}" class="flex flex-col items-center">
          <div class="icon-wrapper bg-lightgreen mb-2">
            <img src="{{ asset('images/send.png') }}" alt="send" class="icon" style="margin-right: 1px;margin-top: 1px" />
          </div>
          <p class="text-xs text-darkblue">Transfer</p>
        </a>
      </x-card>
      <x-card class="flex flex-1 flex-col items-center justify-center">
        <a href="#" class="flex flex-col items-center">
          <div class="icon-wrapper bg-lightred mb-2">
            <img src="{{ asset('images/bag.png') }}" alt="send" class="icon" style="margin-left: 1px" />
          </div>
          <p class="text-xs text-darkblue">Wallet</p>
        </a>
      </x-card>
      <x-card class="flex flex-1 flex-col items-center justify-center">
        <a href="{{ route('transactions.index') }}" class="flex flex-col items-center">
          <div class="icon-wrapper bg-lightsky mb-2">
            <img src="{{ asset('images/history.png') }}" alt="send" class="icon" />
          </div>
          <p class="text-xs text-darkblue">History</p>
        </a>
      </x-card>
    </section>
    <section class="flex flex-wrap gap-3 mt-4">
      <x-card class="flex-1">
        <a href="#" class="flex items-center gap-3">
          <div class="w-6 h-6 overflow-hidden">
            <img src="{{ asset('images/scan.png') }}" alt="scan" class="w-full h-full object-cover object-center">
          </div>
          <span class="text-sm text-gray-600 font-semibold whitespace-nowrap">Scan & Pay</span>
        </a>
      </x-card>
      <x-card class="flex-1">
        <a href="#" class="flex items-center gap-3">
          <div class="w-6 h-6 overflow-hidden">
            <img src="{{ asset('images/qr-code.png') }}" alt="qr-code" class="w-full h-full object-cover object-center">
          </div>
          <span class="text-sm text-gray-600 font-semibold whitespace-nowrap">Receive</span>
        </a>
      </x-card>
    </section>
    <section class="mt-4">
      <x-card>
        <a href="{{ route('transactions.index') }}" class="flex items-center justify-between">
          <span class="flex gap-3 items-center">
            <img src="{{ asset('images/transaction.png') }}" alt="transaction" class="w-6 h-6">
            <span class="text-sm text-gray-600 font-semibold whitespace-nowrap">Transaction</span>
          </span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
          </svg>
        </a>
      </x-card>
    </section>
  </x-frontend.container>
</x-app>

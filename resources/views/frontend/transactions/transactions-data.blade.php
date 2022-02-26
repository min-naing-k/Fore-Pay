@forelse ($transactions as $month => $transactions_data)
  <h1 class="text-gray-500 font-semibold">{{ $month }}</h1>
  @foreach ($transactions_data as $transaction)
    <x-card>
      <a href="#" class="hover:underline text-gray-700 text-sm font-semibold">#{{ $transaction->trx_id }}</a>
      <div class="flex justify-between items-start">
        <div>
          <p class="text-xs text-gray-400">
            {{ $transaction->type == 1 ? 'Receive From' : 'Transfer To' }}
            <span class="text-semibold">{{ $transaction->source ? $transaction->source->name : '-' }}</span>
          </p>
          <p class="text-xs text-gray-400">{{ $transaction->created_at }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500 font-bold">
            {{ $transaction->type == 1 ? '+' : '-' }}{{ number_format($transaction->amount, 2) }}
          </p>
        </div>
      </div>
    </x-card>
  @endforeach
@empty
  <p class="text-center mt-4 text-sm text-gray-500">No Data Found...</p>
@endforelse

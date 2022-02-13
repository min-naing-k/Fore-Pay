<!-- table -->
<div class="my-3 overflow-hidden overflow-x-auto scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-gray-100 scrollbar-thumb-rounded-full scrollbar-track-rounded-full shadow rounded-lg">
  <input id="old-field" type="hidden" value="{{ $field }}">
  <input id="direction" type="hidden" value="{{ $direction }}">
  <table class="w-full divide-y divide-gray-200">
    <thead class="bg-gray-100">
      <tr>
        <th scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          <div class="flex items-center justify-between">
            <span data-field="users.name" class="flex-1 cursor-pointer">Account Owner</span>
            <div data-field="users.name" class="flex items-center cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none h-3 w-3 -mr-1 text-sm {{ $field === 'users.name' && $direction === 'asc' ? 'text-gray-700' : 'text-gray-300' }}"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                  clip-rule="evenodd" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none h-3 w-3 {{ $field === 'users.name' && $direction === 'desc' ? 'text-gray-700' : 'text-gray-300' }}"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z"
                  clip-rule="evenodd" />
              </svg>
            </div>
          </div>
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          <div class="flex items-center justify-between">
            <span data-field="account_number" class="cursor-pointer flex-1 pl-10 lg:pl-3">Account Number</span>
            <div data-field="account_number" class="flex cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none h-3 w-3 -mr-1 text-sm {{ $field === 'account_number' && $direction === 'asc' ? 'text-gray-700' : 'text-gray-300' }}"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                  clip-rule="evenodd" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none h-3 w-3 {{ $field === 'account_number' && $direction === 'desc' ? 'text-gray-700' : 'text-gray-300' }}"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z"
                  clip-rule="evenodd" />
              </svg>
            </div>
          </div>
        </th>
        <th scope="col" class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          <div class="flex items-center justify-between">
            <span data-field="amount" class="flex-1 cursor-pointer">Amount (MMK)</span>
            <div data-field="amount" class="flex items-center cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none h-3 w-3 -mr-1 text-sm {{ $field === 'amount' && $direction === 'asc' ? 'text-gray-700' : 'text-gray-300' }}"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                  clip-rule="evenodd" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none h-3 w-3 {{ $field === 'amount' && $direction === 'desc' ? 'text-gray-700' : 'text-gray-300' }}"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z"
                  clip-rule="evenodd" />
              </svg>
            </div>
          </div>
        </th>
        <th scope="col" class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Created At
        </th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      @forelse ($wallets as $wallet)
        <tr class="bg-white even:bg-gray-100">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="flex-shrink-0 h-10 w-10 overflow-hidden">
                @if ($wallet->user->image)
                  <img class="w-full h-full object-cover rounded-full"
                    src="{{ $wallet->user->profileImage() }}" alt="{{ $wallet->user->name }}">
                @else
                  <img class="min-w-max rounded-full"
                    src="https://ui-avatars.com/api/?format=svg&rounded=true&size=35&name={{ $wallet->user->name }}" alt="{{ $wallet->user->name }}">
                @endif
              </div>
              <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                  {{ $wallet->user->name }}
                </div>
                <div class="text-xs text-gray-500">
                  {{ $wallet->user->email }}
                </div>
                <div class="text-xs mt-1 text-gray-500">
                  {{ $wallet->user->phone }}
                </div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ $wallet->account_number }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ $wallet->amount }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ date('F j, Y, g:i a', strtotime($wallet->created_at)) }}</div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5">
            <p class="text-center text-gray-400 text-sm py-4 px-3">No Data Found...</p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
<!-- Pagination -->
<div>
  {{ $wallets->links('vendor.pagination.custom-pagination') }}
</div>

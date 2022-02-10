<!-- table -->
<div class="my-3 overflow-hidden overflow-x-auto scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-gray-100 scrollbar-thumb-rounded-full scrollbar-track-rounded-full shadow rounded-lg">
  <input id="old-field" type="hidden" value="{{ $field }}">
  <input id="direction" type="hidden" value="{{ $direction }}">
  <table class="w-full divide-y divide-gray-200">
    <thead class="bg-gray-100">
      <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          <div class="flex items-center justify-between">
            <div class="flex">
              @php
                $minus_class = array_intersect($admins->pluck('id')->toArray(), $selected_admins_id) && array_diff($admins->pluck('id')->toArray(), $selected_admins_id) ? 'minus' : '';
                $checked = !count(array_diff($admins->pluck('id')->toArray(), $selected_admins_id)) ? 'checked' : '';
              @endphp
              <input {{ $checked }} type="checkbox" id="global-checkbox" class="border-gray-300 cursor-pointer {{ $minus_class }}"
                style="border-radius: .275rem">
            </div>
            <span data-field="name" class="cursor-pointer flex-1 pl-10 lg:pl-3">Name</span>
            <div data-field="name" class="flex cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none h-3 w-3 -mr-1 text-sm {{ $field === 'name' && $direction === 'asc' ? 'text-gray-700' : 'text-gray-300' }}"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                  clip-rule="evenodd" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none h-3 w-3 {{ $field === 'name' && $direction === 'desc' ? 'text-gray-700' : 'text-gray-300' }}" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z"
                  clip-rule="evenodd" />
              </svg>
            </div>
          </div>
        </th>
        <th scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          <div class="flex items-center justify-between">
            <span data-field="phone" class="flex-1 cursor-pointer">Phone</span>
            <div data-field="phone" class="flex items-center cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none h-3 w-3 -mr-1 text-sm {{ $field === 'phone' && $direction === 'asc' ? 'text-gray-700' : 'text-gray-300' }}"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                  clip-rule="evenodd" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none h-3 w-3 {{ $field === 'phone' && $direction === 'desc' ? 'text-gray-700' : 'text-gray-300' }}" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z"
                  clip-rule="evenodd" />
              </svg>
            </div>
          </div>
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Status
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Role
        </th>
        <th scope="col" class="relative px-6 py-3">
          <span class="sr-only">Edit</span>
        </th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      @forelse ($admins as $admin)
        <tr class="bg-white even:bg-gray-100">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="flex items-center mr-3">
                <input {{ collect($selected_admins_id)->contains($admin->id) ? 'checked' : '' }} type="checkbox"
                  data-id="{{ $admin->id }}" data-name="{{ $admin->name }}"
                  class="local-checkbox cursor-pointer border-gray-300"
                  style="border-radius: .275rem">
              </div>
              <x-dropdown2 class="ml-0 lg:hidden" direction="left">
                <x-slot name="trigger">
                  <button id="action-btn" type="button"
                    class="hover:text-gray-500 focus:outline-none mr-3 text-gray-400 flex items-center justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                    </svg>
                  </button>
                </x-slot>
                <x-dropdown2-link href="#">Edit</x-dropdown2-link>
                <x-dropdown2-link href="#">View</x-dropdown2-link>
                <x-dropdown2-link href="#">Delete</x-dropdown2-link>
              </x-dropdown2>
              <div class="flex-shrink-0 h-10 w-10">
                <img class="min-w-max rounded-full"
                  src="https://ui-avatars.com/api/?format=svg&rounded=true&size=35&name={{ $admin->name }}" alt="">
              </div>
              <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                  {{ $admin->name }}
                </div>
                <div class="text-sm text-gray-500">
                  {{ $admin->email }}
                </div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ $admin->phone }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
              Active
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            Admin
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <div class="flex items-center justify-end flex-nowrap gap-x-1">
              <a href="#" class="text-indigo-600 hover:text-indigo-900 flex items-center mr-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </a>
              <a href="#" class="text-yellow-600 hover:text-yellow-900 flex items-center mr-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
              </a>
              <button id="delete-single" data-admin_id="{{ $admin->id }}" data-name="{{ $admin->name }}" class="text-red-600 hover:text-red-900 flex items-center mr-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </button>
            </div>
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
  {{ $admins->links('vendor.pagination.custom-pagination') }}
</div>

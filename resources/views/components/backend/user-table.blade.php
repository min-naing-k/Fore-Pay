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
                $minus_class = array_intersect($users->pluck('id')->toArray(), $selected_users_id) && array_diff($users->pluck('id')->toArray(), $selected_users_id) ? 'minus' : '';
                $checked = array_intersect($users->pluck('id')->toArray(), $selected_users_id) && !count(array_diff($users->pluck('id')->toArray(), $selected_users_id)) ? 'checked' : '';
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
        <th scope="col" class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          IP
        </th>
        <th scope="col" class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Login At
        </th>
        <th scope="col" class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Status
        </th>
        <th scope="col" class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          User Agent
        </th>
        <th scope="col" class="relative px-6 py-3">
          <span class="sr-only">Edit</span>
        </th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      @forelse ($users as $user)
        <tr class="bg-white even:bg-gray-100">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="flex items-center mr-3">
                <input {{ collect($selected_users_id)->contains($user->id) ? 'checked' : '' }} type="checkbox"
                  data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                  class="local-checkbox cursor-pointer border-gray-300"
                  style="border-radius: .275rem">
              </div>
              @php
                if ($loop->last || $loop->count - 1 == $loop->iteration) {
                    $position = '-top-32';
                }
              @endphp
              <x-dropdown2 class="ml-0 lg:hidden top" direction="left" position="{{ $position ?? '' }}">
                <x-slot name="trigger">
                  <button id="action-btn" type="button"
                    class="hover:text-gray-500 focus:outline-none mr-3 text-gray-400 flex items-center justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                    </svg>
                  </button>
                </x-slot>
                <x-dropdown2-link href="{{ route('admin.user.edit', $user->id) }}">Edit</x-dropdown2-link>
                <x-dropdown2-link href="#">View</x-dropdown2-link>
                <x-dropdown2-link href="#" id="delete-single-dropdown" data-id="{{ $user->id }}" data-name="{{ $user->name }}">Delete</x-dropdown2-link>
              </x-dropdown2>
              <div class="flex-shrink-0 h-10 w-10 overflow-hidden">
                @if ($user->image)
                  <img class="w-full h-full object-cover rounded-full"
                    src="{{ $user->profileImage() }}" alt="{{ $user->name }}">
                @else
                  <img class="min-w-max rounded-full"
                    src="https://ui-avatars.com/api/?format=svg&rounded=true&size=35&name={{ $user->name }}" alt="{{ $user->name }}">
                @endif
              </div>
              <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                  {{ $user->name }}
                </div>
                <div class="text-sm text-gray-500">
                  {{ $user->email }}
                </div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ $user->phone }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            {!! '<span class="text-center text-sm text-gray-700 tracking-wide">' . $user->ip . '</span>' ?? '<span class="text-center text-xs text-gray-400 tracking-wide">No ip yet.. </span>' !!}
          </td>

          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            @if ($user->login_at)
              <p class="text-gray-500 text-sm">{{ date('Y-m-d g:i a', strtotime($user->login_at)) }}</p>
              <small class="text-gray-400 text-xs">{{ \Carbon\Carbon::parse($user->login_at)->diffForHumans() }}</small>
            @else
              <span class="block text-center text-sm text-gray-400">-</span>
            @endif
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            <span class="badge-success">Active</span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-center">
            @php
              if ($user->user_agent) {
                  $agent = new Jenssegers\Agent\Agent();
                  $agent->setUserAgent($user->user_agent);
              }
            @endphp
            @if ($user->user_agent)
              <div class="border border-gray-200 shadow overflow-hidden overflow-x-auto rounded-lg">
                <table class="w-full">
                  <thead class="bg-gray-50 text-sm bg-50 border-b border-gray-200">
                    <th class="px-3 py-2 text-gray-500 font-medium">Device</th>
                    <th class="px-3 py-2 text-gray-500 font-medium">Platform</th>
                    <th class="px-3 py-2 text-gray-500 font-medium">Browser</th>
                  </thead>
                  <tbody>
                    <tr class="text-sm">
                      <td class="px-3 py-2">{{ $agent->device() }}</td>
                      <td class="px-3 py-2">{{ $agent->platform() }}</td>
                      <td class="px-3 py-2">{{ $agent->browser() }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            @else
              <span class="text-center text-xs text-gray-400 tracking-wide">No user agent yet.. </span>
            @endif
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <div class="flex items-center justify-end flex-nowrap gap-x-1">
              <a href="{{ route('admin.user.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 flex items-center mr-1">
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
              <button id="delete-single" data-id="{{ $user->id }}" data-name="{{ $user->name }}" class="text-red-600 hover:text-red-900 flex items-center mr-1">
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
  {{ $users->links('vendor.pagination.custom-pagination') }}
</div>

@forelse ($notifications as $noti)
  <x-card class="relative">
    @if (is_null($noti->read_at))
      <div class="absolute top-0 right-0 w-1.5 h-1.5 rounded-full bg-red-500"></div>
    @endif
    <div class="flex justify-between items-center">
      <a href="{{ route('notification.show', $noti->id) }}" class="text-gray-700 font-medium">{{ $noti->data['title'] }}</a>

      <x-dropdown2 contentClasses="top: 13px">
        <x-slot name="trigger">
          <button type="button" class="text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
              <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
            </svg>
          </button>
        </x-slot>

        <x-dropdown2-link tag="button"
          class="{{ is_null($noti->read_at) ? 'mark-as-read-btn' : 'mark-as-unread-btn' }}"
          data-id="{{ $noti->id }}">
          {{ is_null($noti->read_at) ? 'Mark as read' : 'Mark as unread' }}
        </x-dropdown2-link>
        <x-dropdown2-link tag="button" class="delete-noti-btn" data-id="{{ $noti->id }}">Delete</x-dropdown2-link>
      </x-dropdown2>
    </div>
    <a href="{{ route('notification.show', $noti->id) }}" class="flex justify-between items-center">
      <p class="text-gray-500 text-sm">{{ Str::limit($noti->data['message'], 15) }}</p>
      <p class="text-gray-400 text-xs">{{ $noti->created_at->diffForHumans() }}</p>
    </a>
  </x-card>
@empty
  <p class="text-center mt-4 text-sm text-gray-500">No Data Found...</p>
@endforelse

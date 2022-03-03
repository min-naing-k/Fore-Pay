<x-app title="Notification Detail">
  <x-frontend.container>
    <x-card class="relative">
      <a href="{{ route('notification.index') }}" class="absolute profile-icon">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
        </svg>
      </a>
      <div class="text-center">
        <img src="{{ asset('images/notification.png') }}" alt="notification" class="inline-block" style="width: 150px; height: 150px">
      </div>
      <div class="text-center">
        <h1 class="text-lg font-semibold text-gray-700">{{ $notification->data['title'] }}</h1>
        <p class="text-sm text-gray-500 font-medium">{{ $notification->data['message'] }}</p>
        <small class="text-gray-400">{{ $notification->created_at }}</small>
      </div>
      <div class="text-center mt-4">
        <a href="{{ url($notification->data['web_link']) }}" class="btn-primary">Continue</a>
      </div>
    </x-card>
    </x-frontend.contain>
</x-app>

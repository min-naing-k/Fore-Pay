<x-app title="Edit Password">
  <x-frontend.container style="margin-bottom: 5rem">
    <x-card class="mt-4">
      <section class="flex items-center">
        <a href="{{ route('profile') }}" class="profile-icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
          </svg>
        </a>
        <h1 class="flex-1 text-center font-semibold">Change Password</h1>
      </section>
      <section>
        <div class="flex items-center justify-center">
          <img src="{{ asset('images/security.png') }}" alt="security" class="object-cover object-center" style="width: 150px;height: 150px;" />
        </div>
      </section>
      <section>
        <form action="{{ route('password.update', auth()->id()) }}" method="POST" class="space-y-4">
          @csrf
          <div style="margin-top: 0">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" id="current_password" class="form-control @error('current_password') error @enderror" name="current_password">
            @error('current_password')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="password" class="form-label">New Password</label>
            <input type="password" id="password" class="form-control @error('password') error @enderror" name="password">
            @error('password')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" class="form-control @error('password_confirmation') error @enderror" name="password_confirmation">
            @error('password_confirmation')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="flex items-center justify-end">
            <a href="{{ route('profile') }}" class="btn mr-3">Cancel</a>
            <button type="submit" class="btn-primary">Save Changes</button>
          </div>
        </form>
      </section>
    </x-card>
  </x-frontend.container>
</x-app>

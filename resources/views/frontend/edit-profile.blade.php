<x-frontend.profile-panel>
  <x-card class="mt-4">
    <a href="{{ route('profile') }}" class="profile-icon">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
      </svg>
    </a>
    <form action="{{ route('profile.edit.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="mt-3 space-y-4">
      @csrf
      @method('PATCH')
      <input type="file" class="profile-image-file" name="profile_image" hidden />
      <input type="file" class="cover-image-file" name="cover_image" hidden />
      <input type="text" class="delete-cover-image-file" name="delete_cover_image" hidden />
      <input type="text" class="delete-profile-image-file" name="delete_profile_image" hidden />
      <div>
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" name="name" class="form-control @error('name') error @enderror" value="{{ old('name', $user->name) }}">
        @error('name')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label for="email" class="form-label">Email Address</label>
        <input type="email" id="email" name="email" class="form-control @error('email') error @enderror" value="{{ old('email', $user->email) }}">
        @error('email')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label for="phone" class="form-label">Phone Number</label>
        <input type="text" id="phone" name="phone" class="form-control @error('phone') error @enderror" value="{{ old('phone', $user->phone) }}">
        @error('phone')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="flex items-center justify-end">
        <a href="{{ route('profile') }}" class="btn mr-3">Cancel</a>
        <button type="submit" class="btn-primary">Save Changes</button>
      </div>
    </form>
  </x-card>
</x-frontend.profile-panel>

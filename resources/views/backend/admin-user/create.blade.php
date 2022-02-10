<x-backend.app title="Create Admin User">
  <x-slot name="icon">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
  </x-slot>

  <x-backend.main-panel>
    <form action="{{ route('admin.admin-user.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-4">
        <label class="form-label">Profile Image</label>
        <div class="mt-1 flex items-center">
          {{-- Profile Image --}}
          <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
              <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
          </span>
          <button type="button" class="btn ml-4">Choose</button>
        </div>
      </div>
      <div class="grid grid-cols-6 gap-6">
        <div class="col-span-6 sm:col-span-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" id="name" autocomplete="given-name"
            class="form-control @error('name') error @enderror" value="{{ old('name') }}">
          @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="col-span-6 sm:col-span-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="text" name="email" id="email" autocomplete="email"
            class="form-control @error('email') error @enderror" value="{{ old('email') }}">
          @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="col-span-6 sm:col-span-6">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="number" name="phone" id="phone" autocomplete="phone"
            class="form-control @error('phone') error @enderror" value="{{ old('phone') }}">
          @error('phone')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="col-span-6 sm:col-span-6">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" autocomplete="password"
            class="form-control @error('password') error @enderror">
          @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>
      <div class="flex justify-end mt-3">
        <button type="submit" class="btn-primary">Create</button>
      </div>
    </form>
  </x-backend.main-panel>
</x-backend.app>

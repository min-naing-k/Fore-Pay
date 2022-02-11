<x-backend.app title="Edit Admin User">
  <x-slot name="icon">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
    </svg>
  </x-slot>

  <x-backend.main-panel>
    <form action="{{ route('admin.admin-user.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="mb-4">
        <label class="form-label">Profile Image</label>
        <div class="mt-1 flex items-center">
          {{-- Preview Profile Image --}}
          <input type="hidden" name="delete_profile_image" id="delete-profile-image" />
          <div id="preview-profile-image">
            @if ($admin->image)
              <div class="relative">
                <div class="delete-profile-image-btn">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd" />
                  </svg>
                </div>
              </div>
              <img src="{{ $admin->profileImage() }}" alt="{{ $admin->name }}"
                data-image_path="{{ $admin->image }}"
                class="w-16 h-16 object-cover rounded-full overflow-hidden">
            @else
              <svg id="default-profile" class="inline-block h-16 w-16 rounded-full overflow-hidden bg-gray-100 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
            @endif
          </div>
          <input id="image-file" name="image" type="file" hidden accept="image/png,image/jpg,image/jpeg">
          <button id="choose-image-btn" type="button" class="btn ml-4">Choose</button>
        </div>
        @error('image')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="grid grid-cols-6 gap-6">
        <div class="col-span-6 sm:col-span-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" id="name" autocomplete="given-name"
            class="form-control @error('name') error @enderror" value="{{ old('name', $admin->name) }}">
          @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="col-span-6 sm:col-span-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="text" name="email" id="email" autocomplete="email"
            class="form-control @error('email') error @enderror" value="{{ old('email', $admin->email) }}">
          @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="col-span-6 sm:col-span-6">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="number" name="phone" id="phone" autocomplete="phone"
            class="form-control @error('phone') error @enderror" value="{{ old('phone', $admin->phone) }}">
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
        <a href="{{ route('admin.admin-user.index') }}" class="btn mr-4">Cancel</a>
        <button type="submit" class="btn-primary">Save Changes</button>
      </div>
    </form>
  </x-backend.main-panel>
  <x-slot name="js">
    <script>
      const preview_profile_image = document.querySelector('#preview-profile-image');
      const choose_image_btn = document.querySelector('#choose-image-btn');
      const image_file = document.querySelector('#image-file');
      const image_types = ['image/png', 'image/jpg', 'image/jpeg'];

      choose_image_btn.addEventListener('click', e => {
        image_file.click();
      });

      preview_profile_image.addEventListener('click', e => {
        if (preview_profile_image.children.length > 1) return;
        image_file.click();
      });

      image_file.addEventListener('change', e => previewImage(e.target.files));

      document.addEventListener('click', e => {
        if (e.target.classList.contains('preview-cross')) {
          removePreviewImage();
        }

        if (e.target.classList.contains('delete-profile-image-btn')) {
          const delete_profile_image_el = document.querySelector('#delete-profile-image');
          const image_path = e.target.parentElement.nextElementSibling.dataset.image_path;
          delete_profile_image_el.value = image_path;
          removePreviewImage();
        }
      })

      function previewImage(files) {
        if (!files) return;
        preview_profile_image.innerHTML = "";
        for (let i = 0; i < files.length; i++) {
          const file = files[i];
          if (!image_types.some(image_type => image_type === file.type)) {
            const divEle = document.createElement('div');
            const divEle2 = document.createElement('div');
            divEle.className = 'relative';
            divEle.innerHTML = `
            <div class="preview-cross">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </div>
            `;
            divEle2.className = 'w-16 h-16 flex flex-col items-center justify-center bg-gray-200 text-gray-500 object-cover rounded-full overflow-hidden';
            divEle2.innerHTML = `
            <span class="text-xs text-red-500">Invalid File</span>
            `;
            preview_profile_image.appendChild(divEle);
            preview_profile_image.appendChild(divEle2);
            return;
          }
          const imgEle = document.createElement('img');
          const divEle = document.createElement('div');
          divEle.className = 'relative'
          divEle.innerHTML = `
          <div class="preview-cross">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </div>
          `;
          imgEle.className = 'w-16 h-16 object-cover rounded-full overflow-hidden';
          imgEle.src = URL.createObjectURL(file);
          preview_profile_image.appendChild(divEle);
          preview_profile_image.appendChild(imgEle);
        }
      }

      function removePreviewImage() {
        image_file.value = "";
        preview_profile_image.innerHTML = "";
        preview_profile_image.innerHTML = `
        <svg id="default-profile" class="inline-block h-16 w-16 rounded-full overflow-hidden bg-gray-100 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
          <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        `;
      }
    </script>
  </x-slot>
</x-backend.app>

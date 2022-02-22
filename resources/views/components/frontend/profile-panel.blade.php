<x-app title="Profile">
  <!-- Profile Header -->
  <section class="w-full h-32 bg-gray-200 flex items-center justify-center">
    <!-- Cover Image -->
    <div class="cover-image-preview w-full h-full">
      @if (auth()->user()->cover_image)
        <img src="{{ auth()->user()->coverImage() }}"
          id="{{ !request()->is('profile/edit') ? 'cover-image' : '' }}"
          alt="cover image"
          class="w-full h-full object-cover object-left cursor-pointer" />
      @else
        <div class="w-full h-full flex items-center justify-center">
          <p class="text-gray-300 font-medium select-none">Cover Photo</p>
        </div>
      @endif
    </div>
  </section>
  <x-frontend.container class="mb-20 sm:mb-0">
    <section class="relative" style="min-height: 34px;margin-top: -5px">
      <!-- Profile Image -->
      <div class="relative">
        <div class="profile-image-preview absolute left-0 -top-10 w-20 h-20 p-1 bg-white rounded-full shadow">
          @if (auth()->user()->image)
            <img src="{{ auth()->user()->profileImage() }}" alt="{{ auth()->user()->name }}"
              class="profile-image cursor-pointer w-full h-full rounded-full object-cover" />
          @else
            <img class="w-full h-full object-cover rounded-full"
              src="https://ui-avatars.com/api/?format=svg&rounded=true&size=35&name={{ auth()->user()->name }}" alt="{{ auth()->user()->name }}">
          @endif
        </div>
        @if (request()->is('profile/edit'))
          {{-- Change Profile Image Btn --}}
          <x-dropdown2 class="top-2 left-14" style="position: absolute" direction="left">
            <x-slot name="trigger">
              <button type="button"
                class="profile-image-btn border border-gray-200 text-gray-500 w-7 h-7 rounded-full m-blur cursor-pointer flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </button>
            </x-slot>
            <x-dropdown2-link href="#" id="delete-profile">Delete Profile</x-dropdown2-link>
            <x-dropdown2-link href="#" id="upload-profile">Upload Profile</x-dropdown2-link>
          </x-dropdown2>
        @endif
      </div>
      @if (request()->is('profile/edit'))
        {{-- Change Cover Photo Btn --}}
        <x-dropdown2 class="-top-8 right-0" contentClasses="top: 2.5rem;" style="position: absolute">
          <x-slot name="trigger">
            <button type="button"
              class="cover-image-btn hover:text-stone-500 w-10 h-10 m-blur text-gray-300 rounded-full flex items-center justify-center cursor-pointer shadow-xl transition ease-in-out duration-150">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                  d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z"
                  clip-rule="evenodd" />
              </svg>
            </button>
          </x-slot>
          <x-dropdown2-link href="#" id="delete-cover-image">Delete Cover Photo</x-dropdown2-link>
          <x-dropdown2-link href="#" id="upload-cover-image">Upload Cover Photo</x-dropdown2-link>
        </x-dropdown2>
      @endif
      @if (!request()->is('profile/edit'))
        <div style="padding-left: 5.5rem">
          <p class="text-gray-700 font-semibold leading-4">{{ auth()->user()->name }}</p>
          <small class="text-gray-500 text-xs my-1">{{ auth()->user()->email }} , {{ auth()->user()->phone }}</small>
        </div>
      @endif
    </section>

    {{ $slot }}
  </x-frontend.container>

  <x-slot name="js">
    <script>
      const cover_image_preview = document.querySelector('.cover-image-preview');
      const upload_cover_image = document.querySelector('#upload-cover-image');
      const delete_cover_image = document.querySelector('#delete-cover-image');
      const cover_image_file = document.querySelector('.cover-image-file');
      const delete_cover_image_file = document.querySelector('.delete-cover-image-file');
      const profile_image_preview = document.querySelector('.profile-image-preview');
      const upload_profile = document.querySelector('#upload-profile');
      const delete_profile = document.querySelector('#delete-profile');
      const profile_image_file = document.querySelector('.profile-image-file');
      const delete_profile_image_file = document.querySelector('.delete-profile-image-file');

      //== upload cover photo
      // # click the cover_image_file
      if (upload_cover_image) {
        upload_cover_image.addEventListener('click', e => {
          cover_image_file.click();
        });
      }
      // # change event of cover_image_file
      if (cover_image_file) {
        cover_image_file.addEventListener('change', e => {
          const file = e.target.files[0];
          if (file) {
            cover_image_preview.innerHTML = "";
            const img_el = document.createElement('img');
            const div_el = document.createElement('div');
            div_el.className = 'absolute h-10';
            div_el.style.marginTop = '0';
            div_el.style.left = '50%';
            div_el.style.transform = 'translateX(-50%)';
            div_el.style.maxWidth = '76.2rem';
            div_el.style.width = '95%';
            div_el.innerHTML = `
            <div class="remove-cover-image preview-cross" style="top: 5px">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </div>
            `;
            img_el.className = 'w-full h-full object-cover';
            img_el.src = URL.createObjectURL(file);
            cover_image_preview.appendChild(div_el);
            cover_image_preview.appendChild(img_el);
          }
        });
      }
      // # remove new cover image
      cover_image_preview.addEventListener('click', e => {
        if (e.target.classList.contains('remove-cover-image')) {
          cover_image_preview.innerHTML = "";
          if ('{{ auth()->user()->cover_image }}') {
            cover_image_preview.innerHTML = `
            <img src="{{ auth()->user()->coverImage() }}"
              id="{{ !request()->is('profile/edit') ? 'cover-image' : '' }}"
              alt="cover image"
              class="w-full h-full object-cover object-left cursor-pointer" />
            `;
          } else {
            cover_image_preview.innerHTML = `
            <div class="w-full h-full flex items-center justify-center">
              <p class="text-gray-300 font-medium select-none">Cover Photo</p>
            </div>
            `;
          }
          cover_image_file.value = "";
        }
      })
      // # delete cover photo
      if (delete_cover_image) {
        delete_cover_image.addEventListener('click', e => {
          cover_image_preview.innerHTML = "";
          cover_image_preview.innerHTML = `
          <div class="w-full h-full flex items-center justify-center">
            <p class="text-gray-300 font-medium select-none">Cover Photo</p>
          </div>
            `;
          delete_cover_image_file.value = '{{ auth()->user()->cover_image }}' || null;
        });
      }

      //== upload profile photo
      // # click the profile_image_file
      if (upload_profile) {
        upload_profile.addEventListener('click', e => {
          profile_image_file.click();
        });
      }
      // # change event of profile_image_file
      if (profile_image_file) {
        profile_image_file.addEventListener('change', e => {
          const file = e.target.files[0];
          if (file) {
            profile_image_preview.innerHTML = "";
            const img_el = document.createElement('img');
            const div_el = document.createElement('div');
            div_el.className = 'absolute h-10';
            div_el.style.marginTop = '0';
            div_el.style.left = '50%';
            div_el.style.transform = 'translateX(-50%)';
            div_el.style.maxWidth = '76.2rem';
            div_el.style.width = '95%';
            div_el.innerHTML = `
            <div class="remove-profile-image preview-cross" style="top: 5px">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </div>
            `;
            img_el.className = 'w-full h-full rounded-full object-cover';
            img_el.src = URL.createObjectURL(file);
            profile_image_preview.appendChild(div_el);
            profile_image_preview.appendChild(img_el);
          }
        });
      }
      // # remove new profile image
      profile_image_preview.addEventListener('click', e => {
        if (e.target.classList.contains('remove-profile-image')) {
          profile_image_preview.innerHTML = "";
          if ('{{ auth()->user()->image }}') {
            profile_image_preview.innerHTML = `
            <img src="{{ auth()->user()->profileImage() }}"
              id="{{ !request()->is('profile/edit') ? 'profile-image' : '' }}"
              alt="profile image"
              class="w-full h-full rounded-full object-cover object-left cursor-pointer" />
            `;
          } else {
            profile_image_preview.innerHTML = `
            <img class="w-full h-full object-cover rounded-full"
              src="https://ui-avatars.com/api/?format=svg&rounded=true&size=35&name={{ auth()->user()->name }}" alt="{{ auth()->user()->name }}">
            `;
          }
          cover_image_file.value = "";
        }
      })
      // # delete cover photo
      if (delete_profile) {
        delete_profile.addEventListener('click', e => {
          profile_image_preview.innerHTML = "";
          profile_image_preview.innerHTML = `
          <img class="w-full h-full object-cover rounded-full"
            src="https://ui-avatars.com/api/?format=svg&rounded=true&size=35&name={{ auth()->user()->name }}" alt="{{ auth()->user()->name }}">
          `;
          delete_profile_image_file.value = '{{ auth()->user()->image }}' || null;
        });
      }
    </script>
  </x-slot>
</x-app>

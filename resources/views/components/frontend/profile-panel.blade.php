<x-app title="Profile">
  <!-- Profile Header -->
  <section class="relative w-full h-32 bg-gray-200 flex items-center justify-center">
    <div class="cover-image-preview absolute w-full h-full">
      @if (auth()->user()->cover_image)
        @if (request()->is('profile/edit'))
          <x-frontend.container class="absolute w-full h-full" style="margin-top: 0">
            <div
              class="delete-cover-image-btn cursor-pointer absolute top-2 md:top-2 lg:top-2 right-5 md:right-10 xl:right-4 flex items-center justify-center w-7 h-7 rounded-full bg-white text-red-400 bg-opacity-30">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
            </div>
          </x-frontend.container>
        @endif
        <img src="{{ auth()->user()->coverImage() }}"
          alt="cover image"
          class="w-full h-full object-cover object-left" />
      @endif
    </div>
    <p class="text-gray-300 font-medium select-none">Cover Photo</p>
    @if (!request()->is('profile/edit'))
      <!-- Profile Image -->
      <div class="profile-image-preview lg:hidden absolute left-2 sm:left-4 lg:left-8 -bottom-9 w-20 h-20 p-1 bg-white overflow-hidden rounded-full shadow">
        @if (auth()->user()->image)
          <img src="{{ auth()->user()->profileImage() }}" alt="{{ auth()->user()->name }}"
            class="w-full h-full rounded-full object-cover" />
        @else
          <img class="w-full h-full object-cover rounded-full"
            src="https://ui-avatars.com/api/?format=svg&rounded=true&size=35&name={{ auth()->user()->name }}" alt="{{ auth()->user()->name }}">
        @endif
      </div>
    @endif
  </section>
  <x-frontend.container class="mb-20 sm:mb-0">
    @if (!request()->is('profile/edit'))
      <section class="relative" style="padding-left: 5.5rem;margin-top: -5px">
        <div class="profile-image-preview hidden lg:block absolute left-0 -top-14 w-20 h-20 p-1 bg-white overflow-hidden rounded-full shadow">
          @if (auth()->user()->image)
            <img src="{{ auth()->user()->profileImage() }}" alt="{{ auth()->user()->name }}"
              class="w-full h-full rounded-full object-cover" />
          @else
            <img class="w-full h-full object-cover rounded-full"
              src="https://ui-avatars.com/api/?format=svg&rounded=true&size=35&name={{ auth()->user()->name }}" alt="{{ auth()->user()->name }}">
          @endif
        </div>
        <p class="text-gray-700 font-semibold leading-4">{{ auth()->user()->name }}</p>
        <small class="text-gray-500 text-xs my-1">{{ auth()->user()->email }} , {{ auth()->user()->phone }}</small>
      </section>
    @else
      <section class="relative">
        <!-- Profile Image -->
        <div class="profile-image-preview flex items-center justify-center absolute left-0 -top-28 w-20 h-20 p-1 bg-white rounded-full shadow">
          @if (auth()->user()->image)
            <div
              class="delete-profile-image-btn text-red-400" style="top: 5px;right: -5px;width: 25px;height: 25px;">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
            </div>
            <img src="{{ auth()->user()->profileImage() }}" alt="{{ auth()->user()->name }}"
              class="w-full h-full rounded-full object-cover" />
          @else
            <img class="w-full h-full object-cover rounded-full"
              src="https://ui-avatars.com/api/?format=svg&rounded=true&size=35&name={{ auth()->user()->name }}" alt="{{ auth()->user()->name }}">
          @endif
          <div class="profile-image-btn absolute z-10 w-7 h-7 rounded-full m-blur cursor-pointer flex items-center justify-center top-12 -right-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
        </div>
        <!-- Cover Image Btn -->
        <div
          class="cover-image-btn hover:text-stone-500 w-10 h-10 absolute right-4 m-blur text-gray-300 rounded-full flex items-center justify-center cursor-pointer m-shadow transition ease-in-out duration-150"
          style="margin-top: -5.5rem">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z"
              clip-rule="evenodd" />
          </svg>
        </div>
      </section>
    @endif

    {{ $slot }}
  </x-frontend.container>

  <x-slot name="js">
    <script>
      const cover_image_preview = document.querySelector('.cover-image-preview');
      const cover_image_btn = document.querySelector('.cover-image-btn');
      const cover_image_file = document.querySelector('.cover-image-file');
      const delete_cover_image_btn = document.querySelector('.delete-cover-image-btn');
      const delete_cover_image_file = document.querySelector('.delete-cover-image-file');
      const profile_image_preview = document.querySelector('.profile-image-preview');
      const profile_image_btn = document.querySelector('.profile-image-btn');
      const profile_image_file = document.querySelector('.profile-image-file');
      const delete_profile_image_file = document.querySelector('.delete-profile-image-file');

      // cover image function
      // # add new cover image
      if (cover_image_btn) {
        cover_image_btn.addEventListener('click', e => {
          cover_image_file && cover_image_file.click();
        });
      }

      if (cover_image_file) {
        cover_image_file.addEventListener('change', e => {
          const file = e.target.files[0];
          cover_image_preview.innerHTML = "";
          const imgEle = document.createElement('img');
          const divEle = document.createElement('div');
          divEle.className = 'relative'
          divEle.innerHTML = `
          <div class="preview-cross" style="top: 5px;right: 5px">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </div>
          `;
          imgEle.className = 'w-full h-full object-cover';
          imgEle.src = URL.createObjectURL(file);
          cover_image_preview.appendChild(divEle);
          cover_image_preview.appendChild(imgEle);
        })
      }

      cover_image_preview.addEventListener('click', e => {
        // # delete old cover image
        if (e.target.classList.contains('delete-cover-image-btn')) {
          const path = '{{ auth()->user()->cover_image }}' || null;
          cover_image_preview.innerHTML = "";
          delete_cover_image_file.value = path;
        }

        if (e.target.classList.contains('preview-cross')) {
          let content = '';
          if ('{{ auth()->user()->cover_image }}') {
            content = `
            <div class="m-container absolute w-full h-full" style="margin-top: 0">
              <div
                class="delete-cover-image-btn cursor-pointer absolute top-2 md:top-2 lg:top-2 right-5 md:right-10 xl:right-4 flex items-center justify-center w-7 h-7 rounded-full bg-white text-red-400 bg-opacity-30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </div>
            </div>
            <img src="{{ auth()->user()->coverImage() }}"
              alt="cover image"
              class="w-full h-full object-cover object-left" />
            `;
          }
          cover_image_preview.innerHTML = content;
          cover_image_file.value = "";
        }
      })

      // profile image function
      // # upload new profile image
      if (profile_image_btn) {
        profile_image_btn.addEventListener('click', e => {
          profile_image_file.click();
        });
      }

      if (profile_image_file) {
        profile_image_file.addEventListener('change', e => {
          const file = e.target.files[0];
          profile_image_preview.querySelector('.delete-profile-image-btn') && profile_image_preview.querySelector('.delete-profile-image-btn').remove();
          profile_image_preview.querySelector('img').remove();
          profile_image_preview.querySelector('.preview-cross-wrapper') && profile_image_preview.querySelector('.preview-cross-wrapper').remove();
          const imgEle = document.createElement('img');
          const divEle = document.createElement('div');
          divEle.className = 'relative preview-cross-wrapper'
          divEle.innerHTML = `
          <div class="preview-cross" style="top: -2.5rem;right: -4.5rem">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </div>
          `;
          imgEle.className = 'profile-image w-full h-full rounded-full object-cover';
          imgEle.src = URL.createObjectURL(file);
          profile_image_preview.appendChild(divEle);
          profile_image_preview.appendChild(imgEle);
        })
      }

      profile_image_preview.addEventListener('click', e => {
        // # delete old profile image
        if (e.target.classList.contains('delete-profile-image-btn')) {
          profile_image_preview.querySelector('.profile-image') && profile_image_preview.querySelector('.profile-image').remove();
          profile_image_preview.querySelector('.preview-cross-wrapper') && profile_image_preview.querySelector('.preview-cross-wrapper').remove();
          profile_image_preview.innerHTML = `
          <img class="w-full h-full object-cover rounded-full"
              src="https://ui-avatars.com/api/?format=svg&rounded=true&size=35&name={{ auth()->user()->name }}" alt="{{ auth()->user()->name }}">
          <div class="profile-image-btn absolute z-10 w-7 h-7 rounded-full m-blur cursor-pointer flex items-center justify-center top-12 -right-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
          `;
          delete_profile_image_file.value = '{{ auth()->user()->image }}' || null;
        }

        // # upload new profile image
        if (e.target.classList.contains('preview-cross')) {
          let img_el;
          profile_image_preview.querySelector('.profile-image') && profile_image_preview.querySelector('.profile-image').remove();
          profile_image_preview.querySelector('.preview-cross-wrapper') && profile_image_preview.querySelector('.preview-cross-wrapper').remove();
          if ('{{ auth()->user()->image }}') {
            img_el = `
            <div
              class="delete-profile-image-btn text-red-400" style="top: 5px;right: -5px;width: 25px;height: 25px;">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
            </div>
            <img src="{{ auth()->user()->profileImage() }}" alt="{{ auth()->user()->name }}"
              class="w-full h-full rounded-full object-cover" />
            `;
          } else {
            img_el = `
            <img class="w-full h-full object-cover rounded-full"
              src="https://ui-avatars.com/api/?format=svg&rounded=true&size=35&name={{ auth()->user()->name }}" alt="{{ auth()->user()->name }}">
            `;
          }
          profile_image_preview.innerHTML = `
          ${img_el}
          <div class="profile-image-btn absolute z-10 w-7 h-7 rounded-full m-blur cursor-pointer flex items-center justify-center top-12 -right-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
          `;
          profile_image_file.value = '';
        }
      })
    </script>
  </x-slot>
</x-app>

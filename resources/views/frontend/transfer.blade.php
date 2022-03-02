<x-app title="Transfer">
  <x-frontend.container class="mb-20 sm:mb-0">
    <x-card>
      <section class="flex items-center">
        <a href="{{ route('home') }}" class="profile-icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
          </svg>
        </a>
        <h1 class="flex-1 text-center font-semibold">Transfer Money</h1>
      </section>
      <section>
        <div class="flex items-center justify-center">
          <img src="{{ asset('images/transfer.png') }}" alt="money transfer" class="object-cover object-center" style="width: 150px;height: 150px;" />
        </div>
      </section>
      <section>
        <form action="{{ route('transfer.store') }}" method="POST" id="transfer-form" class="space-y-4">
          @csrf
          <input type="hidden" name="hash_value" id="hash-value" />
          <div style="margin-top: 0">
            <label for="phone" class="form-label">Phone <small class="message"></small></label>
            <div class="relative mt-1">
              <!-- Success Icon -->
              <div class="hidden success-icon absolute top-2/4 right-3 -translate-y-2/4 text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
              </div>
              <!-- Error Icon -->
              <div class="hidden error-icon absolute top-2/4 right-3 -translate-y-2/4 text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
              </div>
              <!-- Loading -->
              <div class="hidden loading-icon absolute top-2/4 right-3 -translate-y-2/4">
                <div class="spinner w-5 h-5 rounded-full border-2 border-t-gray-400 border-gray-200"></div>
              </div>
              @php
                $phone_number = null;
                if (old('phone')) {
                    $phone_number = old('phone');
                } elseif ($phone ?? false) {
                    $phone_number = $phone;
                }
              @endphp
              <input type="number" id="phone" class="form-control placeholder:text-sm @error('phone') error @enderror"
                name="phone" autocomplete="off" style="margin-top: 0" placeholder="09..."
                value="{{ $phone_number }}" />
            </div>
            @error('phone')
              <p class="error-phone-field text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="amount" class="form-label">Amount</label>
            <input type="text" id="amount" class="form-control @error('amount') error @enderror"
              name="amount" autocomplete="off"
              value="{{ old('amount') }}" />
            @error('amount')
              <p class="error-amount-field text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="show-description" class="flex relative items-center mb-4 cursor-pointer">
              <input type="checkbox" id="show-description" class="sr-only">
              <div class="w-11 h-6 bg-gray-200 rounded-full border border-gray-200 toggle-bg dark:bg-gray-700 dark:border-gray-600"></div>
              <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Add Description <small class="text-gray-400 text-xs">(optional)</small></span>
            </label>
          </div>
          <div class="description-wrapper hidden">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
          </div>
          <div class="flex justify-end">
            <button type="submit" id="continue-btn" class="btn-primary">Continue</button>
          </div>
        </form>
      </section>
    </x-card>
    </x-frontend.contain>

    <x-slot name="js">
      <script>
        const phone_el = document.querySelector('#phone');
        const error_phone_field = document.querySelector('.error-phone-field');
        const message_el = document.querySelector('.message');
        const success_icon = document.querySelector('.success-icon');
        const error_icon = document.querySelector('.error-icon');
        const loading_icon = document.querySelector('.loading-icon');
        const amount_el = document.querySelector('#amount');
        const error_amount_field = document.querySelector('.error-amount-field');
        const show_description = document.querySelector('#show-description');
        const description_el = document.querySelector('#description');
        const description_wrapper = document.querySelector('.description-wrapper');
        const continue_btn = document.querySelector('#continue-btn');
        const transfer_form = document.querySelector('#transfer-form');
        const hash_value_el = document.querySelector('#hash-value');
        const session_status = "{{ session('status') }}";
        const session_data = "{{ session('data') }}";

        if (!phone_el.value) {
          phone_el.value = "09";
        }
        if ('{{ $phone ?? false }}') {
          searchUser();
        }
        phone_el.addEventListener('keyup', debounce(searchUser, 500));

        amount_el.addEventListener('keyup', e => {
          amount_el.classList = "form-control";
          if (error_amount_field) error_amount_field.style.display = 'none';
        });

        if (session_status == 'success') {
          renderSuccessMessage(session_data);
        }

        if (session_status == 'fail') {
          renderErrorMessage(session_data);
        }

        continue_btn.addEventListener('click', e => {
          e.preventDefault();
          let url = `/transfer-hash?phone=${phone_el.value}&amount=${amount_el.value}`;
          if (description_el.value) {
            url += `&description=${description_el.value}`;
          }
          axios({
            url,
            method: 'GET'
          }).then(res => {
            if (res.data.status === 'success') {
              hash_value_el.value = res.data.data;
              transfer_form.submit();
            }
          }).catch(err => console.error(err));
        })

        show_description.addEventListener('change', e => {
          if (show_description.checked) {
            description_wrapper.classList.remove('hidden');
          } else {
            description_wrapper.classList.add('hidden');
          }
        });

        function searchUser() {
          let phone = filterPhoneValue(phone_el.value);

          if (error_phone_field) error_phone_field.style.display = 'none';
          success_icon.style.display = 'none';
          error_icon.style.display = 'none';
          loading_icon.style.display = 'block';

          axios({
            method: 'GET',
            url: `/find-user?phone=${phone}`,
          }).then(res => {
            resetPhoneField();
            if (!res.data) return;
            if (res.data.status == 'success') {
              renderSuccessMessage(res.data.message);
            }
            if (res.data.status == 'fail') {
              renderErrorMessage(res.data.message);
            }
          }).catch(err => console.error(err));
        }

        function filterPhoneValue(value) {
          let result;
          result = value.replace(/[^a-zA-Z0-9]/g, '');
          if (result && (result.charAt(0) != 0 || result.charAt(1) != 9)) {
            result = `09${result}`;
          }
          return result;
        }

        function resetPhoneField() {
          loading_icon.style.display = 'none';
          success_icon.style.display = 'none';
          error_icon.style.display = 'none';
          message_el.innerHTML = "";
          phone_el.classList = "form-control";
        }

        function renderSuccessMessage(message) {
          message_el.classList = 'text-green-500';
          message_el.innerHTML = `(${message})`;
          phone_el.classList.add('success');
          success_icon.style.display = 'block';
        }

        function renderErrorMessage(message) {
          message_el.classList = 'text-red-500';
          message_el.innerHTML = `(${message})`;
          phone_el.classList.add('error');
          error_icon.style.display = 'block';
        }
      </script>
    </x-slot>
</x-app>

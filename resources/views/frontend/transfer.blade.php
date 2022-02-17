<x-app title="Transfer">
  <x-frontend.container>
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
        <form action="#" method="POST" class="space-y-4">
          @csrf
          <div class="relative" style="margin-top: 0">
            <!-- Success Icon -->
            <div class="hidden absolute top-0 right-0 text-green-500" style="top: 34px;right: 10px">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
            </div>
            <!-- Error Icon -->
            <div class="absolute top-0 right-0 text-red-500" style="top: 35px;right: 10px">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
            </div>
            <!-- Loading -->
            <div class="hidden absolute top-0 right-0" style="top: 36px;right: 10px">
              <div class="spinner w-5 h-5 rounded-full border-2 border-t-gray-400 border-gray-200"></div>
            </div>
            <label for="phone" class="form-label">To <small class="text-green-500">(Min Naing Kyaw)</small></label>
            <input type="text" id="phone" class="form-control success @error('phone') error @enderror" name="phone" autocomplete="off" />
            @error('phone')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="amount" class="form-label">Amount</label>
            <input type="text" id="amount" class="form-control @error('amount') error @enderror" name="amount" autocomplete="off" />
            @error('amount')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="flex justify-end">
            <button type="submit" class="btn-primary">Continue</button>
          </div>
        </form>
      </section>
    </x-card>
    </x-frontend.contain>
</x-app>

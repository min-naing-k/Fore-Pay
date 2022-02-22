<x-app title="Confirm Transaction">
  <x-frontend.container>
    <x-card class="flex flex-col justify-between">
      <h1 class="font-bold text-xl">Confirm Transaction</h1>
      <section class="mt-4">
        <p class="font-semibold text-gray-700">To:</p>
        <x-card class="flex items-center justify-between">
          <div>
            <p class="font-semibold text-gray-700">{{ $user->name }}</p>
            <p class="text-gray-400 text-sm">{{ $user->phone }}</p>
          </div>
          <div class="w-10 h-10 overflow-hidden">
            @if ($user->image)
              <img src="{{ $user->profileImage() }}" alt="{{ $user->name }}" class="w-full h-full rounded-full object-cover object-center" />
            @else
              <img class="w-full h-full rounded-full object-cover object-center"
                src="https://ui-avatars.com/api/?format=svg&rounded=true&size=35&name={{ $user->name }}" alt="{{ $user->name }}">
            @endif
          </div>
        </x-card>
      </section>
      @if ($description)
        <section class="mt-4">
          <p class="text-gray-500 text-sm font-medium my-4 flex justify-between items-center">
            <span class="text-gray-700 text-base font-semibold mr-3">Description</span>
            <span class="text-right">{{ $description }}</span>
          </p>
        </section>
      @endif
      <section class="mt-4">
        <div class="flex items-center justify-between">
          <p class="font-semibold text-gray-700">Total Amount</p>
          <p class="font-semibold text-right text-gray-700 text-xl">{{ number_format($amount) }} <small class="text-xs">MMK</small></p>
        </div>
      </section>
      <section class="mt-4">
        <div class="flex gap-3">
          <a href="{{ route('transfer') }}" class="flex-1 btn">Cancel</a>
          <button type="button" id="send" class="flex-1 btn-primary">Send</button>
        </div>
      </section>
    </x-card>
    <form action="{{ route('transfer.send') }}" method="POST" id="send-transaction-form">
      @csrf
      <input type="hidden" name="phone" value="{{ $user->phone }}" />
      <input type="hidden" name="amount" value="{{ $amount }}" />
      <textarea hidden name="description">{{ $description }}</textarea>
      <input type="hidden" name="id" value="{{ auth()->id() }}" />
    </form>
    </x-frontend.contain>

    <x-slot name="js">
      <script>
        const send = document.querySelector('#send');
        const send_transaction_form = document.querySelector('#send-transaction-form');

        send.addEventListener('click', e => {
          e.preventDefault();
          sweet_alert_settings.title = `Enter your password to send`;
          sweet_alert_settings.confirmButtonText = 'Send';
          sweet_alert_settings.customClass.confirmButton = 'swal2-confirm-btn';
          sweet_alert_settings.html = `
          <input type="password" id="password" name="password" 
          class="focus:ring-indigo-500 focus:border-indigo-500 focus:ring-inset block w-full shadow-sm sm:text-sm text-center border-gray-300 rounded-md" />
          `;
          Swal.fire(sweet_alert_settings).then(result => {
            if (result.isConfirmed) {
              axios({
                  method: 'POST',
                  url: '/check-password',
                  data: {
                    password: document.querySelector('#password').value,
                    id: '{{ auth()->id() }}',
                  }
                }).then(res => {
                  if (!res.data) return;
                  if (res.data.status == 'success') {
                    send_transaction_form.submit();
                  }
                  if (res.data.status == 'fail') {
                    Swal.fire(res.data.message, '', 'error');
                  }
                })
                .catch(err => console.error(err));
            }
          });
        })
      </script>
    </x-slot>
</x-app>

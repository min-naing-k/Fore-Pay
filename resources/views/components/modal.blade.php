@props(['id' => ''])

<div x-data="{open: false}">
  <div @click="open = ! open">
    {{ $trigger }}
  </div>

  <div
    {{ $attributes->merge([
        'id' => "$id",
        'class' => 'fixed z-10 inset-0 overflow-y-auto',
        'aria-labbeledby' => 'modal-title',
        'role' => 'dialog',
        'aria-modal' => 'true',
        'style' => 'display: none',
        'x-show' => 'open',
        'x-transition:enter' => 'transition ease-out duration-300',
        'x-transition:enter-start' => 'transform opacity-0',
        'x-transition:enter-end' => 'transform opacity-100',
        'x-transition:leave' => 'transition ease-in duration-200',
        'x-transition:leave-start' => 'transform opacity-100',
        'x-transition:leave-end' => 'transform opacity-0',
    ]) }}>
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div id="{{ $id }}" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

      <!-- This element is to trick the browser into centering the modal contents. -->
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

      <!-- Main Model -->
      <div x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="transform opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="transform opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="transform opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        @click.outside="open = false"
        style="min-width: 300px"
        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          {{ $slot }}
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button @click="open = false" id="cancel-btn" type="button"
            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

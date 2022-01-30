<button
  {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-lg font-semibold text-md text-white hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
  {{ $slot }}
</button>

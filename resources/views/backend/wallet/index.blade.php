<x-backend.app title="Wallets">
  <x-slot name="icon">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
    </svg>
  </x-slot>

  <x-backend.main-panel>
    <!-- header -->
    <div class="table-header flex flex-wrap gap-4 items-center justify-between">
      <div class="flex items-center flex-wrap" style="row-gap: 0.5em">
        <div class="mr-3">
          <select class="single-select" id="limit" name="limit" style="outline: none">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="100">100</option>
          </select>
        </div>
      </div>
      <x-search id="wallet-search" placeholder="Search Wallet..." />
    </div>
    <div id="wallet-table"></div>
  </x-backend.main-panel>

  <x-slot name="js">
    <script>
      const wallet_table = document.querySelector('#wallet-table');
      const limit = document.querySelector('#limit');
      const search = document.querySelector('#wallet-search input');
      let direction;

      initTable();

      // JQuery
      // limit
      $(document).ready(function() {
        $('#limit').on('change', function(e) {
          const value = e.target.value;
          const search_value = search.value;
          const field = document.querySelector('#old-field').value;
          const direction = document.querySelector('#direction').value;

          let url = `/admin/wallet-table?limit=${value}`;
          if (search_value) {
            url += `&search=${search_value}`;
          }
          if (field) {
            url += `&field=${field}`;
          }
          if (direction) {
            url += `&direction=${direction}`;
          }
          axios({
            method: 'GET',
            url
          }).then(res => {
            if (!res.data) return;
            wallet_table.innerHTML = res.data;
          }).catch(err => console.error(err));
        });
      })

      // search
      search.addEventListener('keyup', debounce(() => {
        const field = document.querySelector('#old-field').value;
        const direction = document.querySelector('#direction').value;
        let url = `/admin/wallet-table?limit=${limit.value}&search=${search.value}`;
        if (field) {
          url += `&field=${field}`;
        }
        if (direction) {
          url += `&direction=${direction}`;
        }
        axios({
            method: 'GET',
            url
          }).then(res => {
            if (!res.data) return;
            wallet_table.innerHTML = res.data;
          })
          .catch(err => console.error(err))
      }, 300));

      document.addEventListener('click', e => {
        // sort
        if (e.target.dataset.field) {
          const old_field = document.querySelector('#old-field').value;
          const field = e.target.dataset.field;
          if (field != old_field) {
            direction = null;
          }
          direction = direction === 'asc' ? 'desc' : 'asc';
          let url = `/admin/wallet-table?limit=${limit.value}&field=${field}&direction=${direction}`;
          if (search.value) {
            url += `&search=${search.value}`;
          }
          axios({
            method: 'GET',
            url
          }).then(res => {
            if (!res.data) return;
            wallet_table.innerHTML = res.data;
          }).catch(err => console.error(err))
        }

        // pagination
        if (e.target.classList.contains('page-link')) {
          e.preventDefault();
          if (!e.target.href) return;

          let url = e.target.href;
          axios({
            method: 'GET',
            url
          }).then(res => {
            if (!res.data) return;
            wallet_table.innerHTML = res.data;
          }).catch(err => console.error(err))
        }
      })

      function initTable() {
        axios({
            method: 'GET',
            url: '/admin/wallet-table'
          }).then(res => {
            if (!res.data) return;
            wallet_table.innerHTML = res.data;
          })
          .catch(err => console.error(err))
      }
    </script>
  </x-slot>
</x-backend.app>

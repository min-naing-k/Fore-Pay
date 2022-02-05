<x-backend.app title="Admin User Management">
  <x-slot name="icon">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
  </x-slot>

  <x-backend.main-panel>
    <!-- header -->
    <div class="table-header flex items-center justify-between">
      <div>
        <select class="single-select" id="limit" name="limit">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="100">100</option>
        </select>
      </div>
      <x-search id="admin-search" />
    </div>
    <div id="admin-table"></div>
  </x-backend.main-panel>

  <x-slot name="js">
    <script>
      const admin_table = document.querySelector('#admin-table');
      const limit = document.querySelector('#limit');
      const search = document.querySelector('#admin-search input');
      let direction;

      initAdminTable();
      // limit
      $(document).ready(function() {
        $('#limit').on('change', function(e) {
          const value = e.target.value;
          const search_value = search.value;
          const field = document.querySelector('#old-field').value;
          const direction = document.querySelector('#direction').value;

          let url = `/admin/admin-user-table?limit=${value}`;
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
            admin_table.innerHTML = res.data;
          }).catch(err => console.error(err));
        });
      })

      // search
      search.addEventListener('keyup', debounce(() => {
        const field = document.querySelector('#old-field').value;
        const direction = document.querySelector('#direction').value;
        let url = `/admin/admin-user-table?limit=${limit.value}&search=${search.value}`;
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
            admin_table.innerHTML = res.data;
          })
          .catch(err => console.error(err))
      }, 300));

      // sort
      document.addEventListener('click', e => {
        if (e.target.dataset.field) {
          const old_field = document.querySelector('#old-field').value;
          const field = e.target.dataset.field;
          if (field != old_field) {
            direction = null;
          }
          direction = direction === 'asc' ? 'desc' : 'asc';
          let url = `/admin/admin-user-table?limit=${limit.value}&field=${field}&direction=${direction}`;
          if (search.value) {
            url += `&search=${search.value}`;
          }
          axios({
            method: 'GET',
            url
          }).then(res => {
            if (!res.data) return;
            admin_table.innerHTML = res.data;
          }).catch(err => console.error(err))
        }
      })

      // pagination
      document.addEventListener('click', e => {
        if (e.target.classList.contains('page-link')) {
          e.preventDefault();
          if (!e.target.href) return;

          let url = e.target.href;
          axios({
            method: 'GET',
            url
          }).then(res => {
            if (!res.data) return;
            admin_table.innerHTML = res.data;
          }).catch(err => console.error(err))
        }
      })

      function initAdminTable() {
        axios({
            method: 'GET',
            url: '/admin/admin-user-table'
          }).then(res => {
            if (!res.data) return;
            admin_table.innerHTML = res.data;
          })
          .catch(err => console.error(err))
      }
    </script>
  </x-slot>
</x-backend.app>

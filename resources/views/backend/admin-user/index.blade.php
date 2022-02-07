<x-backend.app title="Admin User Management">
  <x-slot name="icon">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
  </x-slot>

  <x-backend.main-panel>
    <!-- header -->
    <div class="table-header flex flex-wrap gap-4 items-center justify-between">
      <div class="flex items-center">
        <div class="mr-3">
          <select class="single-select" id="limit" name="limit">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="100">100</option>
          </select>
        </div>
        <div class="options-selected hidden space-x-2">
          <!-- options-selected unselect btn -->
          <div class="flex">
            <button id="options-selected-unselect-btn" data-tooltip-target="unselected" data-tooltip-style="light" type="button"
              class="hover:bg-gray-200 hover:text-red-500 flex items-center justify-center w-9 h-9 rounded-full bg-gray-100 text-red-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
              </svg>
            </button>
            <div id="unselected" role="tooltip"
              class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
              Unselect All
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
          </div>
          <!-- options-selected delete btn -->
          <div class="flex">
            <button id="options-selected-delete-btn" data-tooltip-target="delete-selected" data-tooltip-style="light" type="button"
              class="hover:bg-gray-200 hover:text-red-500 flex items-center justify-center w-9 h-9 rounded-full bg-gray-100 text-red-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                  clip-rule="evenodd" />
              </svg>
            </button>
            <div id="delete-selected" role="tooltip"
              class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
              Delete
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
          </div>
          <!-- options-selected archive btn -->
          <div class="flex">
            <button id="options-selected-archive-btn" data-tooltip-target="archive-selected" data-tooltip-style="light" type="button"
              class="hover:bg-gray-200 hover:text-orange-500 flex items-center justify-center w-9 h-9 rounded-full bg-gray-100 text-orange-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
              </svg>
            </button>
            <div id="archive-selected" role="tooltip"
              class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
              Move to Archive
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
          </div>
        </div>
        <div id="total-selected"></div>
      </div>
      <x-search id="admin-search" placeholder="Search Admin..." />
    </div>
    <div id="admin-table"></div>
  </x-backend.main-panel>

  <x-slot name="js">
    <script>
      const admin_table = document.querySelector('#admin-table');
      const limit = document.querySelector('#limit');
      const search = document.querySelector('#admin-search input');
      const options_selected = document.querySelector('.options-selected');
      const options_selected_delete_btn = document.querySelector('#options-selected-delete-btn');
      const options_selected_archive_btn = document.querySelector('#options-selected-archive-btn');
      const options_selected_unselected_btn = document.querySelector('#options-selected-unselect-btn');
      const total_selected = document.querySelector('#total-selected');
      const storage_key = 'ADMINS_ID';
      let direction;
      let admins_id = [];

      initAdminTable();

      // JQuery
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
          if (admins_id) {
            url += `&selected_admins_id=${admins_id}`;
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
        if (admins_id) {
          url += `&selected_admins_id=${admins_id}`;
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

      document.addEventListener('click', e => {
        const global_checkbox = document.querySelector('#global-checkbox');
        const local_checkboxs = document.querySelectorAll('.local-checkbox');

        // sort
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
          if (admins_id) {
            url += `&selected_admins_id=${admins_id}`
          }
          axios({
            method: 'GET',
            url
          }).then(res => {
            if (!res.data) return;
            admin_table.innerHTML = res.data;
          }).catch(err => console.error(err))
        }

        // pagination
        if (e.target.classList.contains('page-link')) {
          e.preventDefault();
          if (!e.target.href) return;

          let url = e.target.href;
          if (admins_id) {
            url += `&selected_admins_id=${admins_id}`
          }
          console.log(url);
          axios({
            method: 'GET',
            url
          }).then(res => {
            if (!res.data) return;
            admin_table.innerHTML = res.data;
          }).catch(err => console.error(err))
        }

        // global checkbox
        if (e.target.id === 'global-checkbox') {
          // global check contains minus class
          if (global_checkbox.classList.contains('minus')) {
            global_checkbox.checked = false;
            global_checkbox.classList.remove('minus');
            local_checkboxs.forEach(checkbox => {
              if (checkbox.checked) {
                checkbox.checked = false;
                admins_id = admins_id.filter(id => id != checkbox.dataset.id);
              }
            })
            renderOptionsBar();
          } else {
            // global checked is true
            if (global_checkbox.checked) {
              local_checkboxs.forEach(checkbox => {
                checkbox.checked = true;
                admins_id.push(checkbox.dataset.id);
              });
              renderOptionsBar();
            } else {
              // global checked is false
              local_checkboxs.forEach(checkbox => {
                if (checkbox.checked) {
                  admins_id = admins_id.filter(id => id != checkbox.dataset.id);
                }
                checkbox.checked = false;
              });
              renderOptionsBar();
            }
          }
        }

        // local checkbox
        if (e.target.classList.contains('local-checkbox')) {
          const selected_admins_id = [];
          if (e.target.checked) {
            admins_id.push(e.target.dataset.id);
          } else {
            admins_id = admins_id.filter(id => id != e.target.dataset.id);
          }
          renderOptionsBar();

          local_checkboxs.forEach(checkbox => {
            if (checkbox.checked) {
              selected_admins_id.push(checkbox.dataset.id);
            }
          });
          if (selected_admins_id.length > 0 && selected_admins_id.length !== local_checkboxs.length) {
            global_checkbox.classList.add('minus');
          } else if (selected_admins_id.length <= 0) {
            global_checkbox.classList.remove('minus');
            global_checkbox.checked = false;
          } else {
            global_checkbox.classList.remove('minus');
            global_checkbox.checked = true;
          }
        }
      })

      // options selected unselected btn
      options_selected_unselected_btn.addEventListener('click', e => {
        const global_checkbox = document.querySelector('#global-checkbox');
        const local_checkboxs = document.querySelectorAll('.local-checkbox');
        admins_id = [];
        global_checkbox.checked = false;
        global_checkbox.classList.remove('minus');
        local_checkboxs.forEach(checkbox => checkbox.checked = false);
        options_selected.style.display = 'none';
        total_selected.innerHTML = '';
      })

      // options selected delete btn
      options_selected_delete_btn.addEventListener('click', e => {
        Swal.fire({
          text: 'Are you sure to delete?',
          confirmButtonText: 'Cool'
        })
        const local_checkboxs = document.querySelectorAll('.local-checkbox');
        const selected_admins_id = [];
        local_checkboxs.forEach(checkbox => {
          checkbox.checked && selected_admins_id.push(checkbox.dataset.id);
        })
      })

      // options selected archive btn
      options_selected_archive_btn.addEventListener('click', e => {
        console.log('archive');
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

      function renderOptionsBar() {
        if (admins_id.length) {
          total_selected.innerHTML =
            `<p class="ml-3 text-gray-500 text-sm">
            ${admins_id.length} selected
            </p>
            `;
          options_selected.style.display = 'flex';
        } else {
          total_selected.innerHTML = '';
          options_selected.style.display = 'none';
        }
      }
    </script>
  </x-slot>
</x-backend.app>

<x-backend.app title="User Management">
  <x-slot name="icon">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
    </svg>
  </x-slot>

  <x-backend.main-panel>
    <div class="mb-3">
      <a href="{{ route('admin.user.create') }}" class="btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
        </svg>
        Create User
      </a>
    </div>
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
        <div class="options-selected-bar hidden space-x-2">
          <!-- options-selected unselect btn -->
          <div class="flex">
            <button id="unselect-all-btn" data-tooltip-target="unselected" data-tooltip-style="light" type="button"
              class="hover:bg-gray-200 hover:text-red-500 focus:outline-none flex items-center justify-center w-9 h-9 rounded-full bg-gray-100 text-red-400">
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
            <button id="delete-all-btn" data-tooltip-target="delete-selected" data-tooltip-style="light" type="button"
              class="hover:bg-gray-200 hover:text-red-500 focus:outline-none flex items-center justify-center w-9 h-9 rounded-full bg-gray-100 text-red-400">
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
            <button id="archive-btn" data-tooltip-target="archive-selected" data-tooltip-style="light" type="button"
              class="hover:bg-gray-200 hover:text-orange-500 focus:outline-none flex items-center justify-center w-9 h-9 rounded-full bg-gray-100 text-orange-400">
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
      <x-search id="user-search" placeholder="Search User..." />
    </div>
    <div id="user-table"></div>
  </x-backend.main-panel>

  <x-slot name="js">
    <script>
      const user_table = document.querySelector('#user-table');
      const limit = document.querySelector('#limit');
      const search = document.querySelector('#user-search input');
      const options_selected_bar = document.querySelector('.options-selected-bar');
      const delete_all_btn = document.querySelector('#delete-all-btn');
      const archive_btn = document.querySelector('#archive-btn');
      const unselect_all_btn = document.querySelector('#unselect-all-btn');
      const total_selected = document.querySelector('#total-selected');
      let direction;
      let id = [];
      const sweet_alert_settings = {
        title: 'Title',
        text: 'description',
        showCancelButton: true,
        reverseButtons: true,
        focusConfirm: false,
        confirmButtonText: 'Ok',
        cancelButtonText: 'Cancel',
        customClass: {
          confirmButton: ''
        }
      }
      const sweet_alert_delete_settings = {
        ...sweet_alert_settings,
        title: `Are you sure to delete?`,
        text: "Once you delete this record, you will not get back!",
        confirmButtonText: "Delete",
        customClass: {
          confirmButton: "swal2-delete-btn",
        },
      };

      initTable();

      // JQuery
      // limit
      $(document).ready(function() {
        $('#limit').on('change', function(e) {
          const value = e.target.value;
          const search_value = search.value;
          const field = document.querySelector('#old-field').value;
          const direction = document.querySelector('#direction').value;

          let url = `/admin/user-table?limit=${value}`;
          if (search_value) {
            url += `&search=${search_value}`;
          }
          if (field) {
            url += `&field=${field}`;
          }
          if (direction) {
            url += `&direction=${direction}`;
          }
          if (id) {
            url += `&selected_users_id=${id}`;
          }
          axios({
            method: 'GET',
            url
          }).then(res => {
            if (!res.data) return;
            user_table.innerHTML = res.data;
          }).catch(err => console.error(err));
        });
      })

      // search
      search.addEventListener('keyup', debounce(() => {
        const field = document.querySelector('#old-field').value;
        const direction = document.querySelector('#direction').value;
        let url = `/admin/user-table?limit=${limit.value}&search=${search.value}`;
        if (field) {
          url += `&field=${field}`;
        }
        if (direction) {
          url += `&direction=${direction}`;
        }
        if (id) {
          url += `&selected_users_id=${id}`;
        }
        axios({
            method: 'GET',
            url
          }).then(res => {
            if (!res.data) return;
            user_table.innerHTML = res.data;
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
          let url = `/admin/user-table?limit=${limit.value}&field=${field}&direction=${direction}`;
          if (search.value) {
            url += `&search=${search.value}`;
          }
          if (id) {
            url += `&selected_users_id=${id}`
          }
          axios({
            method: 'GET',
            url
          }).then(res => {
            if (!res.data) return;
            user_table.innerHTML = res.data;
          }).catch(err => console.error(err))
        }

        // pagination
        if (e.target.classList.contains('page-link')) {
          e.preventDefault();
          if (!e.target.href) return;

          let url = e.target.href;
          if (id) {
            url += `&selected_users_id=${id}`
          }
          axios({
            method: 'GET',
            url
          }).then(res => {
            if (!res.data) return;
            user_table.innerHTML = res.data;
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
                id = id.filter(id => id != checkbox.dataset.id);
              }
            })
            renderOptionsBar();
          } else {
            // global checked is true
            if (global_checkbox.checked) {
              local_checkboxs.forEach(checkbox => {
                checkbox.checked = true;
                id.push(checkbox.dataset.id);
              });
              renderOptionsBar();
            } else {
              // global checked is false
              local_checkboxs.forEach(checkbox => {
                if (checkbox.checked) {
                  id = id.filter(id => id != checkbox.dataset.id);
                }
                checkbox.checked = false;
              });
              renderOptionsBar();
            }
          }
        }

        // local checkbox
        if (e.target.classList.contains('local-checkbox')) {
          const selected_id = [];
          if (e.target.checked) {
            id.push(e.target.dataset.id);
          } else {
            id = id.filter(id => id != e.target.dataset.id);
          }
          renderOptionsBar();

          local_checkboxs.forEach(checkbox => {
            if (checkbox.checked) {
              selected_id.push(checkbox.dataset.id);
            }
          });
          if (selected_id.length > 0 && selected_id.length !== local_checkboxs.length) {
            global_checkbox.classList.add('minus');
          } else if (selected_id.length <= 0) {
            global_checkbox.classList.remove('minus');
            global_checkbox.checked = false;
          } else {
            global_checkbox.classList.remove('minus');
            global_checkbox.checked = true;
          }
        }

        // delete single
        if (e.target.id === 'delete-single') {
          e.preventDefault();
          deleteSingle(e.target);
        }

        // delete single dropdown
        if (e.target.id == 'delete-single-dropdown') {
          e.preventDefault();
          deleteSingle(e.target);
        }
      })

      // unselecte all btn
      unselect_all_btn.addEventListener('click', e => {
        const global_checkbox = document.querySelector('#global-checkbox');
        const local_checkboxs = document.querySelectorAll('.local-checkbox');
        id = [];
        global_checkbox.checked = false;
        global_checkbox.classList.remove('minus');
        local_checkboxs.forEach(checkbox => checkbox.checked = false);
        options_selected_bar.style.display = 'none';
        total_selected.innerHTML = '';
      })

      // delete all selected btn
      delete_all_btn.addEventListener('click', e => {
        sweet_alert_delete_settings.title = `Are you sure to delete ${id.length} selected records?`;
        Swal.fire(sweet_alert_delete_settings).then(res => {
          if (res.isConfirmed) {
            axios({
                method: 'DELETE',
                url: `/admin/selected-user/${id}`
              }).then(res => {
                if (res.data) {
                  clearId();
                  initTable();
                  renderSuccessMessage(res.data);
                }
              })
              .catch(err => console.error(err))
          }
        })

      })

      // archive selected btn
      archive_btn.addEventListener('click', e => {
        console.log('archive');
      })

      function initTable() {
        axios({
            method: 'GET',
            url: '/admin/user-table'
          }).then(res => {
            if (!res.data) return;
            user_table.innerHTML = res.data;
          })
          .catch(err => console.error(err))
      }

      function renderOptionsBar() {
        if (id.length) {
          total_selected.innerHTML =
            `<p class="ml-3 text-gray-500 text-sm">
            ${id.length} selected
            </p>
            `;
          options_selected_bar.style.display = 'flex';
        } else {
          total_selected.innerHTML = '';
          options_selected_bar.style.display = 'none';
        }
      }

      function renderSuccessMessage(response) {
        Swal.fire(
          response.status || 'Success!!',
          response.message || 'Completed.',
          'success'
        )
      }

      function clearId() {
        id = [];
        options_selected_bar.style.display = 'none';
        total_selected.innerHTML = '';
      }

      function deleteSingle(button) {
        sweet_alert_delete_settings.title = `Are you sure to delete ${button.dataset.name}?`;
        Swal.fire(sweet_alert_delete_settings).then(result => {
          if (result.isConfirmed) {
            axios({
              method: 'DELETE',
              url: `/admin/user/${button.dataset.id}`
            }).then(res => {
              if (res.data) {
                clearId();
                initTable();
                renderSuccessMessage(res.data);
              }
            })
          }
        });
      }
    </script>
  </x-slot>
</x-backend.app>

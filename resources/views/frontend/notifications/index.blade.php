<x-app title="Notifications">
  <x-frontend.container class="mb-20 sm:mb-10">
    <div class="flex items-center justify-between">
      <h1 class="text-lg font-semibold text-gray-700 mb-3">Notifications</h1>
      <div>
        <x-dropdown2 contentClasses="top: 13px">
          <x-slot name="trigger">
            <button type="button" class="text-gray-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
              </svg>
            </button>
          </x-slot>

          <x-dropdown2-link tag="button" id="mark-as-all-read-btn">Mark all as read</x-dropdown2-link>
          <x-dropdown2-link tag="button">Delete all</x-dropdown2-link>
        </x-dropdown2>
      </div>
    </div>
    <div id="notifications-data" class="space-y-4">
      @include('frontend.notifications.notifications-data')
    </div>
    <div id="loading-wrapper">
      <svg id="loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: none;margin: auto; background: #f2f2f2;shape-rendering: auto;"
        width="50px"
        height="50px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
        <g transform="rotate(0 50 50)">
          <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#4a46ff">
            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.9166666666666666s" repeatCount="indefinite"></animate>
          </rect>
        </g>
        <g transform="rotate(30 50 50)">
          <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#4a46ff">
            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.8333333333333334s" repeatCount="indefinite"></animate>
          </rect>
        </g>
        <g transform="rotate(60 50 50)">
          <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#4a46ff">
            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.75s" repeatCount="indefinite"></animate>
          </rect>
        </g>
        <g transform="rotate(90 50 50)">
          <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#4a46ff">
            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.6666666666666666s" repeatCount="indefinite"></animate>
          </rect>
        </g>
        <g transform="rotate(120 50 50)">
          <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#4a46ff">
            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5833333333333334s" repeatCount="indefinite"></animate>
          </rect>
        </g>
        <g transform="rotate(150 50 50)">
          <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#4a46ff">
            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite"></animate>
          </rect>
        </g>
        <g transform="rotate(180 50 50)">
          <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#4a46ff">
            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.4166666666666667s" repeatCount="indefinite"></animate>
          </rect>
        </g>
        <g transform="rotate(210 50 50)">
          <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#4a46ff">
            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.3333333333333333s" repeatCount="indefinite"></animate>
          </rect>
        </g>
        <g transform="rotate(240 50 50)">
          <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#4a46ff">
            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.25s" repeatCount="indefinite"></animate>
          </rect>
        </g>
        <g transform="rotate(270 50 50)">
          <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#4a46ff">
            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.16666666666666666s" repeatCount="indefinite"></animate>
          </rect>
        </g>
        <g transform="rotate(300 50 50)">
          <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#4a46ff">
            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.08333333333333333s" repeatCount="indefinite"></animate>
          </rect>
        </g>
        <g transform="rotate(330 50 50)">
          <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#4a46ff">
            <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animate>
          </rect>
        </g>
      </svg>
      <p class="loading-text text-center mt-4 text-xs text-gray-500" style="display: none"></p>
    </div>
  </x-frontend.container>

  <x-slot name="js">
    <script>
      const notifications_data = document.querySelector('#notifications-data');
      const loading_wrapper = document.querySelector('#loading-wrapper');
      const loading = document.querySelector('#loading');
      const loading_text = document.querySelector('.loading-text');
      const mark_as_all_read_btn = document.querySelector('#mark-as-all-read-btn');
      let data = true;
      let page = 1;

      mark_as_all_read_btn.addEventListener('click', e => {
        axios({
          url: `/mark-all-as-read`,
          method: 'GET'
        }).then(res => {
          if (res.data.status === 'success') {
            notifications_data.innerHTML = res.data.data;
          }
        }).catch(err => console.error(err));
      })

      document.addEventListener('click', e => {
        // mark as read
        if (e.target.classList.contains('mark-as-read-btn')) {
          e.preventDefault();
          const mark_as_read_btn = e.target;
          const noti_id = mark_as_read_btn.dataset.id;
          axios({
            url: `/mark-as-read?noti_id=${noti_id}`,
            method: 'GET'
          }).then(res => {
            if (res.data.status === 'success') {
              notifications_data.innerHTML = res.data.data;
            }
          }).catch(err => console.error(err));
        }

        // mark as unread
        if (e.target.classList.contains('mark-as-unread-btn')) {
          e.preventDefault();
          const mark_as_unread_btn = e.target;
          const noti_id = mark_as_unread_btn.dataset.id;
          axios({
            url: `/mark-as-unread?noti_id=${noti_id}`,
            method: 'GET'
          }).then(res => {
            if (res.data.status === 'success') {
              notifications_data.innerHTML = res.data.data;
            }
          }).catch(err => console.error(err));
        }

        // delete noti
        if (e.target.classList.contains('delete-noti-btn')) {
          e.preventDefault();
          const delete_noti_btn = e.target;
          const noti_id = delete_noti_btn.dataset.id;
          axios({
            url: `/notification/${noti_id}`,
            method: 'DELETE'
          }).then(res => {
            if (res.data.status === 'success') {
              notifications_data.innerHTML = res.data.data;
            }
          }).catch(err => console.error(err));
        }
      });

      window.onscroll = e => {
        if ((window.innerHeight + window.pageYOffset) >= document.documentElement.offsetHeight) {
          page++;
          data && loadMore(page);
        }
      }

      function loadMore(page) {
        loading.style.display = "block";
        axios({
            url: `?page=${page}`,
            method: 'GET'
          }).then(res => {
            if (!res.data) return;
            loading.style.display = "none";
            if (!res.data.html) {
              data = false;
              loading_text.style.display = "block";
              loading_text.textContent = "No more Data Found..";
            } else {
              notifications_data.innerHTML += res.data.html;
            }
          })
          .catch(err => console.error(err));
      }
    </script>
  </x-slot>
</x-app>

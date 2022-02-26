<x-app title="Transactions">
  <section class="w-full">
    <div class="m-container py-3" style="margin-top: 0;">
      <h1 class="text-xl flex items-center mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
        </svg>
        Filter
      </h1>
      <div class="flex items-end search-wrapper">
        <div class="mr-4">
          <label class="block text-gray-500 text-sm mb-1">Type</label>
          <select id="type" class="single-select" style="width: 0%">
            <option value="">All</option>
            <option value="1" {{ request('type') == 1 ? 'selected' : '' }}>Income</option>
            <option value="2" {{ request('type') == 2 ? 'selected' : '' }}>Expense</option>
          </select>
        </div>
        <div class="search-date-wrapper">
          <label class="text-gray-500 text-sm mb-1 block">Range Date</label>
          <div class="search-date relative h-10 w-60">
            <input type="text" class="range-date-picker form-control absolute w-full h-full" style="margin-top: 0;"
              value="{{ request('start-date') && request('end-date') ? "request('start-date') - request('end-date')" : '' }}" />
            <div class="absolute right-2 text-gray-400" style="top: 50%;transform: translateY(-50%);">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <x-frontend.container class="mb-20 sm:mb-10">
    <div id="transactions-data" class="space-y-4">
      @include('frontend.transactions.transactions-data')
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
      <p class="loading-text text-center mt-4 text-sm text-gray-500" style="display: none"></p>
    </div>
  </x-frontend.container>

  <x-slot name="js">
    <script>
      $(document).ready(function() {
        const search_by_range = document.querySelector('#search-by-range');
        const single_date_picker = document.querySelector('.single-date-picker');
        const range_date_picker = document.querySelector('.range-date-picker');
        const transactions_data = document.querySelector('#transactions-data');
        const loading_wrapper = document.querySelector('#loading-wrapper');
        const loading = document.querySelector('#loading');
        const loading_text = document.querySelector('.loading-text');
        const type = document.querySelector('#type');
        const start_date_from_url = '{{ request('start-date') }}' || null;
        const end_date_from_url = '{{ request('end-date') }}' || null;
        let page = 1;
        let data = true;
        let search_date = $('.range-date-picker').data('daterangepicker');

        start_date_from_url && search_date.setStartDate(moment(start_date_from_url, 'YYYY/MM/DD'));
        end_date_from_url && search_date.setEndDate(moment(end_date_from_url, 'YYYY/MM/DD'));

        $('#type').on('change', function(e) {
          page = 1;
          data = true;
          const start_date = search_date.startDate.format('YYYY-MM-DD');
          const end_date = search_date.endDate.format('YYYY-MM-DD');
          transactions_data.innerHTML = "";
          loading.style.display = "block";
          loading_text.style.display = 'none';
          if (type.value) {
            history.pushState(null, '', `?type=${type.value}&start-date=${start_date}&end-date=${end_date}`);
          } else {
            history.pushState(null, '', `?start-date=${start_date}&end-date=${end_date}`);
          }
          axios({
              url: `?type=${e.target.value}&start-date=${start_date}&end-date=${end_date}`,
              method: 'GET'
            }).then(res => {
              if (!res.data) return;
              loading.style.display = "none";
              if (!res.data.html) {
                loading_text.style.display = 'block';
                loading_text.textContent = 'No Data Found...';
              } else {
                transactions_data.innerHTML = res.data.html;
              }
            })
            .catch(err => console.error(err));
        });

        $('.range-date-picker').on('apply.daterangepicker', function(ev, picker) {
          page = 1;
          data = true;
          const start_date = picker.startDate.format('YYYY-MM-DD');
          const end_date = picker.endDate.format('YYYY-MM-DD');
          transactions_data.innerHTML = "";
          loading.style.display = "block";
          loading_text.style.display = 'none';
          let url = `?start-date=${start_date}&end-date=${end_date}`;
          if (type.value) {
            url = `?type=${type.value}&start-date=${start_date}&end-date=${end_date}`;
          }
          history.pushState(null, '', url);
          axios({
              url,
              method: 'GET'
            }).then(res => {
              if (!res.data) return;
              loading.style.display = "none";
              if (!res.data.html) {
                loading_text.style.display = 'block';
                loading_text.textContent = 'No Data Found...';
              } else {
                transactions_data.innerHTML = res.data.html;
              }
            })
            .catch(err => console.error(err));
        })

        window.onscroll = e => {
          if ((window.innerHeight + window.pageYOffset) >= document.documentElement.offsetHeight) {
            page++;
            data && loadMoreTransactions(page);
          }
        }

        function loadMoreTransactions(page) {
          loading.style.display = "block";
          const start_date = search_date.startDate.format('YYYY-MM-DD');
          const end_date = search_date.endDate.format('YYYY-MM-DD');
          let url = `?start-date=${start_date}&end-date=${end_date}&page=${page}`;
          if (type.value) {
            url = `?start-date=${start_date}&end-date=${end_date}&type=${type.value}&page=${page}`;
          }
          axios({
              url,
              method: 'GET'
            }).then(res => {
              if (!res.data) return;
              loading.style.display = "none";
              if (!res.data.html) {
                data = false;
                loading_text.style.display = 'block';
                loading_text.textContent = 'No More Data...';
              } else {
                transactions_data.innerHTML += res.data.html;
              }
            })
            .catch(err => console.error(err));
        }
      })
    </script>
  </x-slot>
</x-app>

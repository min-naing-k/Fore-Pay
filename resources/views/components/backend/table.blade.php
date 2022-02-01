@props(['admins'])
<!-- header -->
<div class="flex items-center justify-between">
  <div>
    <select name="amount">
      <option value="10">10</option>
      <option value="25">25</option>
      <option value="100">100</option>
    </select>
  </div>
  <div>
    <x-search />
  </div>
</div>
<!-- table -->
<div class="my-4 overflow-hidden overflow-x-auto scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-gray-100 scrollbar-thumb-rounded-full scrollbar-track-rounded-full shadow rounded-lg">
  <table class="w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
      <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Name
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Phone
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Status
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Role
        </th>
        <th scope="col" class="relative px-6 py-3">
          <span class="sr-only">Edit</span>
        </th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      @foreach ($admins as $admin)
        <tr>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="flex-shrink-0 h-10 w-10">
                <img class="h-8 w-8 min-w-max rounded-full"
                  src="https://ui-avatars.com/api/?size=35&background=random&name={{ $admin->name }}" alt="">
              </div>
              <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                  {{ $admin->name }}
                </div>
                <div class="text-sm text-gray-500">
                  {{ $admin->email }}
                </div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ $admin->phone }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
              Active
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            Admin
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-1">Edit</a>
            <a href="#" class="text-yellow-600 hover:text-yellow-900 mr-1">View</a>
            <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!-- footer -->
<div class="flex items-center justify-between">
  <div>
    <p class="text-gray-500 text-sm">Showing 1 to 5 of 20 users</p>
  </div>
  <div>
    pagination
  </div>
</div>

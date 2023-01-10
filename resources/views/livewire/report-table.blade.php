<table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Id</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Title</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Status</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Image</th>
            <th scope="col" class="relative px-6 py-3">Edit</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($reports as $report)
                    <tr class="">
                      <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $report->id }}</div></td>
                    </tr>
                    @endforeach
        </tbody>
      </table>
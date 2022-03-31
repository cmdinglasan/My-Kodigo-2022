<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Region
                </th>
                <th scope="col" class="px-6 py-3">
                    Province
                </th>
                <th scope="col" class="px-6 py-3">
                    Location
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($locations as $location)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    {{ $location->id }}
                </th>
                <td class="px-6 py-4">
                    {{ $location->region }}
                </td>
                <td class="px-6 py-4">
                    {{ $location->province }}
                </td>
                <td class="px-6 py-4">
                    {{ $location->location }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="p-4 bg-gray-50">
        {{ $locations->links() }}
    </div>
</div>
<div 
    x-data="{ locations: [], location: '', isLoading: true }" 
    x-init="
        $nextTick(() => {
            fetch('{{ route('api.locations') }}')
                .then(response => response.json())
                .then(data => locations = data.data)
                .then(() => isLoading = false),
            $watch('location', value => {
                if(value) {
                    $dispatch('location-selected', value)
                }
            })
        })
    "
    class="flex"
>
    <select class="relative w-full flex items-center py-2 pl-3 pr-10 border bg-white overflow-hidden duration-75 rounded-lg shadow-sm focus-within:border-primary-600 focus-within:ring-1 focus-within:ring-inset focus-within:ring-primary-600 focus:outline-none border-gray-300" x-model="location" :disabled="isLoading">
        <template x-if="isLoading">
            <option value="" disabled selected>Loading...</option>
        </template>
        <option value="" hidden>Select your location</option>
        <template x-for="location in locations">
            <option x-bind:value="location.slug" x-text="location.location"></option>
        </template>
    </select>
</div>
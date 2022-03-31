<x-default-layout>
  <div class="md:flex items-center justify-center px-4" x-data="votingFunction()" x-on:location-selected.window="changeLocation($event.detail)">
      <div class="p-2 space-y-2 bg-white rounded-xl shadow relative max-w-md mx-auto">
          <div class="space-y-2">
              <div class="px-4 py-2 space-y-4">
                  <div class="space-y-2">
                      <h2 class="text-lg sm:text-xl font-bold tracking-light">
                          Where are you voting?
                      </h2>
                      <span class="text-sm text-gray-500 leading-3">
                          Before we start, we need to know where you are voting this coming Philippine Elections 2022.
                      </span>
                      <livewire:location-selector />
                  </div>
              </div>
          </div>
      </div>
  </div>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('votingFunction', () => ({
        changeLocation (location) {
          // redirect to a url
          window.location.replace(`/voting?location=${location}`)
        },
      }))
    })
  </script>
</x-default-layout>
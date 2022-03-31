<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Positions') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div>
              <div class="flex space-x-4">
                  <livewire:position-form />
                  <livewire:position-table />
              </div>
          </div>
      </div>
  </div>
</x-app-layout>

<x-guest-layout>
  <x-auth-card>
      <x-slot name="logo"></x-slot>
      {{-- @dd(Route::currentRouteName()) --}}
      @if(!Auth::user()->isConfirmed())
      <div class="text-sm text-gray-600 p-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-500 h-16 w-16 mx-auto" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
        <p class="text-center mb-2">
          <strong>Thanks for signing up!</strong>
        </p>
        <p class="text-center">
          Before getting started, you need to be confirmed by an admin first.
        </p>
        <div>
          <form method="POST" action="{{ route('logout') }}" class="flex">
            @csrf
            <x-button type="submit" class="mt-4 w-full justify-center">
              {{ __('Logout instead') }}
            </x-button>
          </form>
        </div>
      </div>
      @else
      <div class="text-sm text-gray-600 p-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="text-green-500 h-16 w-16 mx-auto" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <p class="text-center mb-2">
          <strong>Account is already confirmed</strong>
        </p>
        <p class="text-center">
          You may now continue to the dashboard.
        </p>
        <div>
          <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-4 w-full justify-center">
            {{ __('Go to Dashboard') }}
          </a>
        </div>
      </div>
      @endif
  </x-auth-card>
</x-guest-layout>

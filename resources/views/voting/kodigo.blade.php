<x-default-layout>
  <div class="relative pb-16 space-y-6 kodigo" x-data="kodigo">

      <div class="relative">
        <div class="container mx-auto px-4">
          <div>
            <span class="text-gray-500">
              Voting Location:
            </span>
          </div>
          <h1 class="text-2xl md:text-4xl font-bold leading-tight text-gray-900">
            {{ $location->location }}
          </h1>
        </div>
      </div>

      <div class="sticky top-0 z-20 bg-gray-100">
        <div class="container mx-auto px-4">
          <div class="flex items-center justify-between py-2">
            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
              <span class="hidden md:inline">Back to Locations</span>
            </a>

            <x-button type="button" x-on:click="printKodigo()"> 
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
              </svg>
              <span class="hidden md:inline md:ml-2">Print</span>
            </x-button>
          </div>
        </div>
      </div>

      @foreach($candidates as $key => $position)
        @if($position['data']->count() > 0)
          <!-- {{ $position['title'] }} -->
          <section class="relative flex flex-col space-y-2" id="kodigo-{{ $key }}">
              <div class="sticky top-[54px] z-10 bg-gray-100 space-y-2 items-start justify-between py-2 sm:flex sm:space-y-0 sm:space-x-4 sm:rtl:space-x-reverse sm:py-4">
                <div class="container mx-auto px-4">
                  <h1 class="text-2xl font-bold tracking-tight md:text-3xl">
                    {{ $position['title'] }}
                  </h1>
                  <span class="text-xl text-gray-500 sm:text-right">{{ $position['description'] }}</span>
                </div>
              </div>
              <div class="relative">
                  <div class="space-y-2 container mx-auto px-4">
                      <style>
                      </style>
                      <div class="grid grid-flow-col grid-cols-1 lg:grid-cols-4 gap-4 custom-rows" style="--row-template-count: {{ $position['num_rows'] }}; --row-count: {{ $position['data']->count() }}">
                        @foreach ($position['data'] as $index => $candidate)
                          <label for="{{ $position['slug'] }}-{{ $candidate->entry_number }}" class="flex items-center space-x-4 p-3 bg-white shadow rounded-md select-none">
                              <input type="{{ $position['type'] }}" id="{{ $position['slug'] }}-{{ $candidate->entry_number }}" name="{{ $position['slug'] }}" value="{{ $candidate->entry_number }} {{ $candidate->ballot_name }}@if($candidate->partylist_code) ({{ $candidate->partylist_code }})@endif" x-model="selectedCandidates.{{ $position['slug'] }}" class="border-red-500 text-gray-600 transition duration-150 ease-in-out">
                              <span class="text-gray-500">
                                  {{ $candidate->entry_number }} {{ $candidate->ballot_name }} @if($candidate->partylist_code) ({{ $candidate->partylist_code }}) @endif
                              </span>
                          </label>
                        @endforeach
                      </div>
                  </div>
              </div>
          </section>
        @endif
      @endforeach
  </div>

  <script src="https://printjs-4de6.kxcdn.com/print.min.js" defer></script>

  <script defer>
    document.addEventListener('alpine:init', () => {
      Alpine.data('kodigo', () => ({
        selectedCandidates: {
          president: '',
          vicePresident: '',
          senators: [],
          representative: '',
          mayor: '',
          viceMayor: '',
          sanggunians: [],
          partylist: ''
        },
        location: @json($location->slug),
        printKodigo () {
          const selectedCandidates = this.selectedCandidates

          let candidates = {}

          // if location is national, remove representative, mayor, vice mayor, and sanggunian
          if (this.location === 'national') {
            candidates = {
              president: selectedCandidates.president,
              vicePresident: selectedCandidates.vicePresident,
              senators: selectedCandidates.senators,
              partylist: selectedCandidates.partylist
            }
          } else {
            candidates = {
              president: selectedCandidates.president,
              vicePresident: selectedCandidates.vicePresident,
              senators: selectedCandidates.senators,
              representative: selectedCandidates.representative,
              mayor: selectedCandidates.mayor,
              viceMayor: selectedCandidates.viceMayor,
              sanggunians: selectedCandidates.sanggunians,
              partylist: selectedCandidates.partylist
            }
          }

          // validate if selectedCandidates is empty
          // get keys without values or has proxy object
          const emptyKeys = Object.keys(candidates).filter(key => !candidates[key] || typeof candidates[key] === 'object')

          console.table(candidates)
          // check if value is proxy object
          if (Object.values(candidates).some(value => value === '')) {
            Swal.fire({
              title: 'Oops!',
              text: 'Please select at least one candidate per position.',

              icon: 'error',
              confirmButtonText: 'Ok'
            })
            return
          }

          const candidatesList = Object.entries(candidates).reduce((acc, [category, candidate]) => {
            if (candidate) {
              acc.push({
                category: category.charAt(0).toUpperCase() + category.slice(1),
                candidate
              })
            }
            return acc
          }, [])
          
          printJS({
            printable: candidatesList,
            properties: ['category', 'candidate'],
            type: 'json',
            header: 'My Kodigo 2022',
          })
        }
      }))
    })
  </script>
</x-default-layout>
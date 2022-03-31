<div>
    <form wire:submit.prevent="store">
        <div class="mb-4">
            <x-label for="position">{{ __('Position') }}</x-label>
            <x-select id="position" type="text" wire:model.defer="position" :options="$positions"/>
            @error('position') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <x-label for="entryNumber">{{ __('Entry Number') }}</x-label>
            <x-input id="entryNumber" type="text" wire:model.defer="entryNumber" />
            @error('entryNumber') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <x-label for="ballotName">{{ __('Ballot Name') }}</x-label>
            <x-input id="ballotName" type="text" wire:model.defer="ballotName" />
            @error('ballotName') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <x-label for="location">{{ __('Location') }}</x-label>
            <x-select id="location" type="text" wire:model.defer="location" :options="$locations"/>
            @error('location') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <x-label for="partylistCode">{{ __('Partylist Code') }}</x-label>
            <x-select id="partylistCode" type="text" wire:model.defer="partylistCode" />
            @error('partylistCode') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>
        <div>
            <x-button type="submit">{{ __('Save') }}</x-button>
        </div>
    </form>
</div>

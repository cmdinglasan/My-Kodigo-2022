<div>
    <form wire:submit.prevent="store">
        <div class="mb-4">
            <x-label for="region">{{ __('Region') }}</x-label>
            <x-input id="region" type="text" wire:model.defer="region" />
            @error('region') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <x-label for="province">{{ __('Province') }}</x-label>
            <x-input id="province" type="text" wire:model.defer="province" />
            @error('province') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <x-label for="location">{{ __('Location') }}</x-label>
            <x-input id="location" type="text" wire:model.defer="location" />
            @error('location') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>
        <div>
            <x-button type="submit">{{ __('Save') }}</x-button>
        </div>
    </form>
</div>

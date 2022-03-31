<div>
    <form wire:submit.prevent="store">
        <div class="mb-4">
            <x-label for="name">{{ __('Position') }}</x-label>
            <x-input id="name" type="text" wire:model.defer="name" />
            @error('name') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        </div>
        <div>
            <x-button type="submit">{{ __('Save') }}</x-button>
        </div>
    </form>
</div>

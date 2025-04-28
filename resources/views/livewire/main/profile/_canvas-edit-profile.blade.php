<div>
    <form wire:submit="updateProfile">
        <x-ts-slide id="change-profile">
            <x-slot:title>
                Ubah Profile
            </x-slot:title>
            <div wire:key="{{ $image_render_key }}">
                <div class="flex items-center gap-1">
                    <label class="block text-sm font-semibold text-gray-600 dark:text-dark-400">Foto</label>
                </div>
                <x-filepond::upload wire:model="fp" />
            </div>
            <div class="grid grid-cols-1 gap-4 mt-4">
                <x-ts-input type="text" label="Nama *" icon="user" wire:model="name" />
                <x-ts-input type="email" label="Email *" icon="envelope" wire:model="email" />
                <x-ts-input type="number" label="No. Telphone" icon="phone" wire:model="phone_number" />
            </div>
            <div class="grid grid-cols-1 gap-4 mt-10">
                <h1 class="text-sm text-gray-500 italic">Isi jika ingin merubah password</h1>
                <x-ts-password type="password" label="Password Baru *" icon="key" wire:model="password" />
                <x-ts-password type="password" label="Konfirmasi Password *" icon="key"
                    wire:model="password_confirmation" />
            </div>

            <x-slot:footer>
                <div class="flex items-center gap-4 w-full">
                    <x-buttons.button x-on:click="$slideClose('change-profile')" color="default" iconClass="ti ti-x text-lg"
                        class="gap-2 w-full">
                        Batal
                    </x-buttons.button>
                    <x-buttons.button type="submit" target="updateProfile" color="success"
                        iconClass="ti ti-device-floppy text-lg" class="gap-2 w-full">
                        Simpan
                    </x-buttons.button>
                </div>
            </x-slot:footer>
        </x-ts-slide>
    </form>
</div>
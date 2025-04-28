<div>
    <div class="container w-full py-10">
        <h1 class="page-heading">Tambah Postingan</h1>
        <form wire:submit="updateOrCreate" class="bg-white shadow rounded-xl p-4">
            <div class="mt-4 grid grid-cols-1 gap-4 ">
                <div>
                    <div class="flex items-center gap-1">
                        <label class="block text-sm font-semibold text-gray-600 dark:text-dark-400">Foto</label>
                        <span class="font-bold not-italic text-red-500">*</span>
                    </div>
                    <x-filepond::upload wire:model="images" max-files="5" multiple />
                </div>
                <x-ts-input label="Judul *" wire:model="title" />
                <x-ts-textarea label="Kontent *" wire:model="content" />
            </div>
            <div class="mt-4 flex justify-end gap-2">
                <x-buttons.button color="default" iconClass="ti ti-x text-lg" class="gap-2">
                    Batal
                </x-buttons.button>
                <x-buttons.button type="submit" target="updateOrCreate" color="primary"
                    iconClass="ti ti-device-floppy text-lg" class="gap-2">
                    Simpan
                </x-buttons.button>
            </div>
        </form>
    </div>
</div>
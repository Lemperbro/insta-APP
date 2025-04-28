<div>

    @include('livewire.main.profile._modal-show-post')
    @include('livewire.main.profile._canvas-edit-profile')
    <div class="container">
        <div class=" mx-auto  p-8 bg-white min-h-screen shadow">

            <div class="flex items-center space-x-8">

                <div>
                    <img src="{{ $user?->fp ? Storage::url($user?->fp) : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}"
                        alt="Profile" class="w-32 h-32 rounded-full object-cover">
                </div>

                <div class="flex-1">
                    <div class="flex items-center space-x-4">
                        <h2 class="text-2xl font-semibold">{{ $user?->name }}</h2>
                        @if (Auth::user()->id == $user?->id)
                            <button class="px-4 py-1 text-sm font-semibold border rounded cursor-pointer"
                                x-on:click="$slideOpen('change-profile')" wire:click="loadProfileForm">Edit Profile</button>
                        @endif
                    </div>
                    <div class="flex space-x-6 mt-4">
                        <div><span class="font-semibold">{{ $allPost->total() }}</span> posts</div>
                    </div>
                    <div class="mt-2">
                        <p class="font-semibold">{{ $user?->email }}</p>
                    </div>
                </div>
            </div>

            <div class="border-t-[1px] mt-8 py-10">

                <div>
                    <h1 class="page-heading">Paling Banyak Like</h1>
                    <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 mt-2">
                        <div class="flex items-center gap-4 pb-4">
                            @foreach ($postByLike as $item)
                                <div class="cursor-pointer group" wire:click="showDataPost('{{ $item?->id }}')"
                                    x-on:click="$modalOpen('show-post')">
                                    <div>
                                        <img src="{{ Storage::url($item?->postImages()->first()?->image) }}" alt=""
                                            class="w-96 h-80 object-cover rounded-xl group-hover:scale-95 transition-all ease-in-out duration-500 group-hover:rotate-6 group-hover:shadow">
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                    <div>
                        @if ($postByLike->count() <= 0)
                            <div class="flex items-center justify-center h-full p-4 mt-8">
                                <div class="flex flex-col items-center gap-1 text-center">
                                    <img src="{{ asset('assets/icons/empty.svg') }}" alt=""
                                        class="object-contain w-40 h-40">
                                    <p class="text-gray-500 dark:text-neutral-400">Tidak ada postingan</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div>
                    <h1 class="page-heading">Semua Postingan</h1>
                    <div class="grid mt-4 grid-cols-4 gap-4 ">
                        @foreach ($allPost as $item)

                            <div class="cursor-pointer group" wire:click="showDataPost('{{ $item?->id }}')"
                                x-on:click="$modalOpen('show-post')">
                                <div>
                                    <img src="{{ Storage::url($item?->postImages()->first()?->image) }}" alt=""
                                        class="w-full h-80 object-cover rounded-xl group-hover:scale-95 transition-all ease-in-out duration-500 group-hover:rotate-6 group-hover:shadow">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        @if ($allPost->count() <= 0)
                            <div class="flex items-center justify-center h-full p-4 mt-8">
                                <div class="flex flex-col items-center gap-1 text-center">
                                    <img src="{{ asset('assets/icons/empty.svg') }}" alt=""
                                        class="object-contain w-40 h-40">
                                    <p class="text-gray-500 dark:text-neutral-400">Tidak ada postingan</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>
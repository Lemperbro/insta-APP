<div>
    @include('livewire.main.profile._modal-show-post')
    <div class="container mx-auto  py-8 bg-white min-h-screen shadow">
        <!-- Profile header -->
        <div class="flex items-center space-x-8">
            <!-- Profile Picture -->
            <div>
                <img src="https://imageio.forbes.com/specials-images/imageserve/5d35eacaf1176b0008974b54/0x0.jpg?format=jpg&crop=4560,2565,x790,y784,safe&height=900&width=1600&fit=bounds"
                    alt="Profile" class="w-32 h-32 rounded-full object-cover">
            </div>
            <!-- Profile Info -->
            <div class="flex-1">
                <div class="flex items-center space-x-4">
                    <h2 class="text-2xl font-semibold">{{ $user?->name }}</h2>
                    <button class="px-4 py-1 text-sm font-semibold border rounded">Edit Profile</button>
                </div>
                <div class="flex space-x-6 mt-4">
                    <div><span class="font-semibold">{{ $allPost->total() }}</span> posts</div>
                    <div><span class="font-semibold">1,200</span> followers</div>
                    <div><span class="font-semibold">300</span> following</div>
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
                            <div class="cursor-pointer group" wire:click="showDataPost('{{ $item?->id }}')" x-on:click="$modalOpen('show-post')">
                                <div>
                                    <img src="{{ Storage::url($item?->postImages()->first()?->image) }}" alt=""
                                        class="w-96 h-80 object-cover rounded-xl group-hover:scale-95 transition-all ease-in-out duration-500 group-hover:rotate-6 group-hover:shadow">
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <div>
                <h1 class="page-heading">Semua Postingan</h1>
                <div class="grid mt-4 grid-cols-4 gap-4 ">
                    @foreach ($allPost as $item)

                        <div class="cursor-pointer group" wire:click="showDataPost('{{ $item?->id }}')" x-on:click="$modalOpen('show-post')">
                            <div>
                                <img src="{{ Storage::url($item?->postImages()->first()?->image) }}" alt=""
                                    class="w-full h-80 object-cover rounded-xl group-hover:scale-95 transition-all ease-in-out duration-500 group-hover:rotate-6 group-hover:shadow">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>


</div>
<div>
    @include('livewire.main.beranda._modal-show-comment')
    <div class="container">
        <div class=" mx-auto  p-8 bg-white min-h-screen shadow">

            <div class="grid grid-cols-1 gap-1 max-w-3xl  mx-auto">

                @foreach ($datas as $item)
                                <div class="">
                                    <a href="{{ route('profile', ['id' => $item?->userable_id]) }}"
                                        class="py-4 flex items-center gap-2 cursor-pointer">
                                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Profile"
                                            class="w-10 h-10 rounded-full object-cover">
                                        <div class="flex flex-col">
                                            <h1 class="font-semibold">{{ $item?->userable?->name }}</h1>
                                            <span class="text-xs text-gray-500">{{ $item?->userable?->email }}</span>
                                        </div>
                                    </a>
                                    @php
                                        $images = collect($item?->postImages->pluck('image')->toArray())
                                            ->map(fn($image, $loop) => [
                                                'src' => Storage::url($image),
                                                'alt' => 'Wallpaper ' . $loop,
                                            ])
                                            ->toArray();
                                       @endphp

                                    <x-ts-carousel :images="$images" />
                                    <div class="p-4">
                                        <div class="flex items-center gap-4">
                                            <div class=" flex flex-col items-center cursor-pointer"
                                                wire:click="saveLike('{{ $item?->id }}')">
                                                <i
                                                    class="ti {{ $item?->postLikes()->where('user_id', Auth::user()->id)->exists() ? 'ti-heart-filled' : 'ti-heart'}} text-2xl"></i>
                                                <span class="text-xs">{{ $item?->postLikes()->count() }} Suka</span>
                                            </div>
                                            <div class="flex flex-col items-center cursor-pointer"
                                                wire:click="setComment('{{ $item?->id }}')" x-on:click="$modalOpen('show-comment')">
                                                <i class="ti ti-brand-line text-2xl"></i>
                                                <span class="text-xs">{{  $item?->postComments()->count() }} Komentar</span>
                                            </div>
                                        </div>

                                        <div class="mt-4 pb-10 border-b-[1px]">
                                            <h1 class="post-title">{{ $item?->title }}</h1>
                                            <p class="text-sm text-gray-500">{{ $item?->content }}</p>
                                        </div>
                                    </div>
                                </div>
                @endforeach

            </div>

        </div>
    </div>
</div>
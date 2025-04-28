<div>
    <x-ts-modal id="show-post" size="6xl" center>
        @if ($showPost !== null)
                <div class="grid grid-cols-2 gap-4 ">
                    <div>
                        @php
                            $images = collect($showPost?->postImages->pluck('image')->toArray())
                                ->map(fn($image, $loop) => [
                                    'src' => Storage::url($image),
                                    'alt' => 'Wallpaper ' . $loop,
                                ])
                                ->toArray();
                           @endphp

                        <x-ts-carousel :images="$images" />
                    </div>
                    <div class="{{ $is_show_comment ? 'hidden' : 'block' }}">
                        <div class="">
                            <span class="text-xs text-gray-500">Di upload Pada
                                {{ formatDate($showPost?->created_at, 'D MMMM YYYY HH:mm') }}</span>
                            <h1 class="page-heading">{{ $showPost?->title }}</h1>
                            <div class="max-h-[400px] h-full overflow-y-auto">
                                <p class="text-gray-500">{{ $showPost?->content }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 mt-4 border-t-[1px] pt-2">
                            <div class=" flex flex-col items-center cursor-pointer" wire:click="saveLike">
                                <i
                                    class="ti {{ $showPost?->postLikes()->where('user_id', Auth::user()->id)->exists() ? 'ti-heart-filled' : 'ti-heart'}} text-2xl"></i>
                                <span class="text-xs">{{ $showPost?->postLikes()->count() }} Suka</span>
                            </div>
                            <div class="flex flex-col items-center cursor-pointer" wire:click="$set('is_show_comment', true)">
                                <i class="ti ti-brand-line text-2xl"></i>
                                <span class="text-xs">{{  $showPost?->postComments()->count() }} Komentar</span>
                            </div>
                        </div>
                    </div>
                    <form wire:submit="addComment" class="{{ $is_show_comment ? 'block' : 'hidden' }}">
                        <div class="flex items-center justify-between">
                            <h1 class="page-heading">Komentar</h1>
                            <span class="cursor-pointer" wire:click="$set('is_show_comment', false)">
                                <i class="ti ti-x text-2xl"></i>
                            </span>
                        </div>

                        <div class="max-h-[280px] h-full overflow-y-auto border rounded-lg p-2 flex flex-col gap-2">
                            @foreach ($showPost?->postComments as $comment)
                                <div class="flex flex-col gap-2 justify-end bg-lime-50 rounded-lg p-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                            <i class="ti ti-user text-xl"></i>
                                        </div>
                                        <h1 class="text-sm font-semibold ">{{ $comment?->user?->name }}
                                            @if ($comment?->user_id == $showPost?->userable_id)
                                                <span
                                                    class="bg-lime-200 text-lime-600 px-2 py-1 rounded-lg text-xs font-normal">Author</span>
                                            @endif
                                        </h1>
                                    </div>
                                    <p class="text-sm text-gray-500">{{ $comment?->content }}</p>
                                    <span
                                        class="text-sm text-gray-500">{{ formatDate($comment?->created_at, 'D MMMM YYYY HH:mm') }}</span>
                                </div>

                            @endforeach
                        </div>
                        <div class="mt-2">
                            <x-ts-textarea label="Tulis Komentar" wire:model="comment" />
                            <div class="mt-2 flex justify-end">
                                <x-buttons.button type="submit" color="primary">
                                    Simpan
                                </x-buttons.button>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="py-2 justify-end flex">
                @if ($showPost?->userable_id == Auth::user()->id) 
                        <x-buttons.button iconClass="ti ti-trash" color="danger" wire:click="deletePost('{{ $showPost?->id }}')" target="deletePost">
                            Hapus Postingan
                        </x-buttons.button>
                @endif
                </div>
        @endif
    </x-ts-modal>
</div>
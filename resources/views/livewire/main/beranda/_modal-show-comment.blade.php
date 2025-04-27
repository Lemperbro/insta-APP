<div>
    <x-ts-modal id="show-comment" size="6xl" center>
        @if ($comments)
            <div class="flex items-center justify-between">
                <h1 class="page-heading">Komentar</h1>
            </div>
            <div class="py-4 border-b-[1px]">
                <h1 class="post-title">{{ $comments->first()?->postable?->title }}</h1>
                <p class="text-sm text-gray-500">{{ $comments->first()?->postable?->content }}</p>
            </div>
            <form wire:submit="addComment('{{ $comments->first()?->postable_id }}')" class="mt-4 ">

                <div class="max-h-[280px] h-full overflow-y-auto border rounded-lg p-2 flex flex-col gap-2">
                    @foreach ($comments as $comment)
                        <div class="flex flex-col gap-2 justify-end bg-lime-50 rounded-lg p-2">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                    <i class="ti ti-user text-xl"></i>
                                </div>
                                <h1 class="text-sm font-semibold ">{{ $comment?->user?->name }}
                                    @if ($comment?->user_id == $comment?->postable?->userable_id)
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
        @endif
    </x-ts-modal>
</div>
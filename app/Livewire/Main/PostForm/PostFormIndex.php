<?php

namespace App\Livewire\Main\PostForm;

use Exception;
use Livewire\Component;
use App\Models\Auth\User;
use App\Traits\UploadFile;
use App\Models\Content\Post;
use App\Traits\HandleFilePond;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\HandledException;
use Illuminate\Support\Facades\Auth;
use TallStackUi\Traits\Interactions;
use Illuminate\Support\Facades\Storage;

class PostFormIndex extends Component
{
    use Interactions, UploadFile, HandleFilePond;
    public $id, $title, $content, $images = [];
    public function mount($id = null)
    {
        if ($id) {
            $data = Post::findOrFail($id);
            $this->loadData($data);
        }
    }

    public function render()
    {
        return view('livewire.main.post-form.post-form-index');
    }
    public function loadData($data)
    {
        $this->id = $data?->id;
        $this->title = $data?->title;
        $this->content = $data?->content;
        $this->images = collect($data?->postImages->pluck('image')->toArray())
            ->map(fn($image) => Storage::url($image))
            ->toArray();
    }
    public function updateOrCreate()
    {
        try {
            $user = User::find(Auth::user()->id);
            DB::beginTransaction();
            $post = $user->posts()->updateOrCreate([
                'id' => $this->id
            ], [
                'title' => $this->title,
                'content' => $this->content
            ]);
            $post = $post->fresh();
            if ($this->id !== null) {
                $post->postImages()->whereIn('image', collect($this->vanue_images)->map(fn($image) => self::saverOrUpdateFile($this->images, 'post'))->toArray())->delete();
            }
            if ($post) {
                foreach ($this->images as $image) {
                    $post->postImages()->create([
                        'image' => self::saverOrUpdateFile($image, 'post')
                    ]);
                }
            }
            DB::commit();
            $this->toast()->success('Berhasil', 'Postingan berhasil disimpan')->flash()->send();
            $this->redirect(route('profile', ['id' => Auth::user()->id]));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->toast()->error('Gagal', 'Terjadi kesalahan sistem')->send();
        }
    }
}

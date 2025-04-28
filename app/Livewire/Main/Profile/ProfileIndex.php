<?php

namespace App\Livewire\Main\Profile;

use Exception;
use Livewire\Component;
use App\Models\Auth\User;
use App\Traits\UploadFile;
use App\Models\Content\Post;
use Livewire\WithPagination;
use App\Traits\HandleFilePond;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use TallStackUi\Traits\Interactions;
use Illuminate\Support\Facades\Storage;

class ProfileIndex extends Component
{
    use WithPagination, Interactions, HandleFilePond, UploadFile;
    public $user;
    public $showPost;
    public $renderDetailKey = 'default';
    public $is_show_comment = false;
    public $comment;
    public $name, $email, $phone_number, $password, $password_confirmation, $fp;
    public $image_render_key = 'default';
    protected $rules = [
        'comment' => 'required|string|max:255',
    ];
    public function mount($id)
    {
        $this->user = User::find($id);
    }
    public function render()
    {

        return view('livewire.main.profile.profile-index', [
            'allPost' => $this->allPost,
            'postByLike' => $this->postByLike,
        ]);
    }
    public function getAllPostProperty()
    {
        return Post::byUser($this->user?->id)->with(['postImages'])->latest()->paginate(10);
    }

    public function getPostByLikeProperty()
    {
        return Post::byUser($this->user?->id)->with(['postImages'])->withCount('postLikes')
            ->orderByDesc('post_likes_count')
            ->limit(4)
            ->get();
    }
    public function showDataPost($id)
    {
        $this->renderDetailKey = rand(1, 1000);
        $this->showPost = Post::byUser($this->user?->id)->with(['postImages', 'postLikes', 'postComments.user'])->find($id);
    }

    public function saveLike()
    {
        $exists = $this->showPost->postLikes()->where('user_id', Auth::user()->id)->first();
        if ($exists) {
            $exists->delete();
        } else {
            $this->showPost->postLikes()->create([
                'user_id' => Auth::user()->id,
            ]);
        }
    }
    public function addComment()
    {
        $this->validate();
        $this->showPost->postComments()->create([
            'content' => $this->comment,
            'user_id' => Auth::user()->id,
        ]);
        $this->reset('comment');
    }

    public function deletePost($id)
    {
        $this->dialog()
            ->warning('Peringatan!', 'Apakah anda yakin ingin menghapus data ini?')
            ->confirm('Hapus', 'deletePostExecution', $id)
            ->send();
    }
    public function deletePostExecution($id)
    {
        try {
            $post = Post::find($id);
            abort_if($post?->userable_id !== Auth::user()->id, 403, 'Anda tidak memiliki akses ke post ini');
            $post->postLikes()->delete();
            $post->postComments()->delete();
            $post->postImages()->delete();
            $post->delete();
            $this->showPost = null;
            $this->toast()->success('Berhasil', 'Berhasil menghapus postingan')->send();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $this->toast()->error('Gagal', 'Terjadi kesalahan sistem')->send();
        }
    }
    public function loadProfileForm()
    {
        $user = User::find(Auth::user()->id);
        $this->name = $user?->name;
        $this->email = $user?->email;
        $this->phone_number = $user?->phone_number;
        $this->fp = Storage::url($user?->fp);
        $this->image_render_key = rand(1, 100000);
    }
    public function updateProfile()
    {
        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'phone_number' => 'nullable|string|max:20',
            'fp' => 'nullable|image|mimes:jpeg,png,jpg,webp'
        ];
        if ($this->password) {
            $validationRules['password'] = 'required|min:8|confirmed';
            $validationRules['password_confirmation'] = 'required';
        }
        $this->validate($validationRules);
        try {
            $user = User::find(Auth::user()->id);
            $user->fp = self::saverOrUpdateFile($this->fp, 'user');
            $user->name = $this->name;
            $user->email = $this->email;
            $user->phone_number = $this->phone_number;
            if ($this->password) {
                $user->password = $this->password;
            }
            $user->save();

            $this->reset(['password', 'password_confirmation']);
            $this->toast()->success('Berhasil', 'Berhasil memperbarui profile')->send();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $this->toast()->error('Gagal', 'Terjadi kesalahan sistem')->send();
        }
    }

}

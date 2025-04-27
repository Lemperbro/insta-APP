<?php

namespace App\Livewire\Main\Profile;

use Livewire\Component;
use App\Models\Auth\User;
use App\Models\Content\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ProfileIndex extends Component
{
    use WithPagination;
    public $user;
    public $showPost;
    public $renderDetailKey = 'default';
    public $is_show_comment = false;
    public $comment;
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
        return Post::with(['postImages'])->latest()->paginate(10);
    }

    public function getPostByLikeProperty()
    {
        return Post::with(['postImages'])->withCount('postLikes')
            ->orderByDesc('post_likes_count')
            ->limit(4)
            ->get();
    }
    public function showDataPost($id)
    {
        $this->renderDetailKey = rand(1, 1000);
        $this->showPost = Post::with(['postImages', 'postLikes', 'postComments.user'])->find($id);
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
}

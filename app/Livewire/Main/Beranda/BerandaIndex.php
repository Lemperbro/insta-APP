<?php

namespace App\Livewire\Main\Beranda;

use Livewire\Component;
use App\Models\Content\Post;
use App\Models\Content\PostComment;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class BerandaIndex extends Component
{
    use WithPagination;

    public $comments;
    public $comment;
    protected $rules = [
        'comment' => 'required|string|max:255',
    ];
    public function render()
    {
        return view('livewire.main.beranda.beranda-index', [
            'datas' => $this->datas,
        ]);
    }
    public function getDatasProperty()
    {
        return Post::with(['userable', 'postImages', 'postLikes', 'postComments'])->latest()->paginate(15);
    }
    public function saveLike($id)
    {
        $post = Post::find($id);
        $exists = $post->postLikes()->where('user_id', Auth::user()->id)->first();
        if ($exists) {
            $exists->delete();
        } else {
            $post->postLikes()->create([
                'user_id' => Auth::user()->id,
            ]);
        }
    }
    public function setComment($id)
    {
        $comment = PostComment::with(['postable', 'user'])->where('postable_id', $id)->latest()->get();
        $this->comments = $comment;
    }
    public function addComment($id)
    {
        $this->validate();
        Post::find($id)->postComments()->create([
            'content' => $this->comment,
            'user_id' => Auth::user()->id,
        ]);
        $this->reset('comment');
        $this->setComment($id);
    }
}

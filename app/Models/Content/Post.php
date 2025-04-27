<?php

namespace App\Models\Content;


use App\Models\Content\PostLike;
use App\Models\Content\PostComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, HasUuids, SoftDeletes;
    protected $guarded = ['id'];

    public function userable()
    {
        return $this->morphTo();
    }
    public function postImages()
    {
        return $this->morphMany(PostImage::class, 'postable');
    }
    public function postLikes()
    {
        return $this->morphMany(PostLike::class, 'postable');
    }
    public function postComments()
    {
        return $this->morphMany(PostComment::class, 'postable');
    }

}

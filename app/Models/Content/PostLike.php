<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostLike extends Model
{
    /** @use HasFactory<\Database\Factories\PostLikesFactory> */
    use HasFactory,SoftDeletes,HasUuids;
    protected $guarded = ['id'];
}

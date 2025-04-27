<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostImage extends Model
{
    /** @use HasFactory<\Database\Factories\PostImagesFactory> */
    use HasFactory, SoftDeletes, HasUuids;
    protected $guarded = ['id'];
}

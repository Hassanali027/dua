<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'author_name',
        'author_image',
        'image_path',
        'meta_title',
        'meta_description',
        'long_description',
        'status',
        'is_popular',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'youtube_link',
    ];
}

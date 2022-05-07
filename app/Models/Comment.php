<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Taggable;

class Comment extends Model
{
    use HasFactory, SoftDeletes, Taggable;

    protected $fillable = ['user_id', 'content'];

    public function commentable()
    {
        return $this->morphTo();
    }

    // public function blogPost()
    // {
    //     // return $this->belongsTo('App\Models\BlogPost', 'post_id', 'blog_post_id');
    //     return $this->belongsTo('App\Models\BlogPost');
    // }

    public function user() {
        return $this->belongsTo(User::class);    
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }
}

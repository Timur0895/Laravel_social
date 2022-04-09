<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_path',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function likes()
    {
      return $this->morphMany(Like::class, 'likeable');
    }

    public function scopeNotReply($query)
    {
      return $query->whereNull('parent_id');
    }

    public function replies()
    {
      return $this->hasMany(Post::class, 'parent_id');
    }

}

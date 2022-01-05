<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    use Blameable;
    protected $fillable = ['category_id', 'post_title', 'post_slug', 'post_thumbnail', 'post_excerpt', 'post_desc', 'post_meta_title', 'post_meta_description', 'post_meta_keyword', 'is_active'];


    public function scopeSearch($query, $title)
    {
        return $query->where('post_title', 'LIKE', "%{$title}%");
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id')->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(CategoriesPost::class);
    }

    public function scopePublish($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeDraft($query)
    {
        return $query->where('is_active', 0);
    }
    public function getRouteKeyName()
    {
        return 'post_slug';
    }
}

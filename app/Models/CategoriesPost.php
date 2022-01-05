<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesPost extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'categories_posts';
    protected $fillable = ['category_title', 'category_slug', 'category_desc', 'is_active'];

    public function scopeOnlyParent($query)
    {
        return $query->whereNull('id');
    }

    public function scopeSearch($query, $title)
    {
        return $query->where('category_title', 'LIKE', "%{$title}%");
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getRouteKeyName()
    {
        return 'category_slug';
    }
}

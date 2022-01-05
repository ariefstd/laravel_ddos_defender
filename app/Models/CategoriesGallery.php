<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesGallery extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'categories_galleries';
    protected $fillable = ['cat_gallery_name', 'cat_gallery_slug', 'cat_gallery_seq', 'is_active'];

    public function scopeOnlyParent($query)
    {
        return $query->whereNull('id');
    }

    public function scopeSearch($query, $title)
    {
        return $query->where('cat_gallery_name', 'LIKE', "%{$title}%");
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function getRouteKeyName()
    {
        return 'cat_gallery_slug';
    }
}

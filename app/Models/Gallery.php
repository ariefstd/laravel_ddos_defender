<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'galleries';
    use Blameable;
    protected $fillable = ['image_name', 'image_slug', 'image_image', 'image_desc', 'is_active'];


    public function scopeSearch($query, $title)
    {
        return $query->where('image_name', 'LIKE', "%{$title}%");
    }

    public function categories()
    {
        return $this->belongsToMany(CategoriesGallery::class, 'category_gallery', 'gallery_id', 'category_id')->withTimestamps();
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
        return 'image_slug';
    }
}

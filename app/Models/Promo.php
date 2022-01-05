<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class Promo extends Model
{
    use HasFactory;
    protected $table = 'promos';
    use Blameable;
    protected $fillable = ['promo_title', 'promo_slug', 'promo_thumbnail', 'promo_excerpt', 'promo_description', 'promo_meta_title', 'promo_meta_description', 'promo_meta_keyword', 'is_active'];


    public function scopeSearch($query, $title)
    {
        return $query->where('promo_title', 'LIKE', "%{$title}%");
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
        return 'promo_slug';
    }
}

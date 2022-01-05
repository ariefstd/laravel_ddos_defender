<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'banners';
    protected $fillable = ['banner_name', 'banner_slug', 'banner_image', 'banner_seq', 'is_active'];

    public function scopeSearch($query, $name)
    {
        return $query->where('banner_name', 'LIKE', "%{$name}%");
    }

    public function scopePublish($query)
    {
        return $query->where('is_active', '1');
    }
    public function scopeDraft($query)
    {
        return $query->where('is_active', '0');
    }

    public function getRouteKeyName()
    {
        return 'banner_slug';
    }
}

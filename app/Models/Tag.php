<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class Tag extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'tags';
    protected $fillable = ['tag_title', 'tag_slug', 'is_active'];

    public function scopeSearch($query, $title)
    {
        return $query->where('tag_title', 'LIKE', "%{$title}%");
    }

    public function getRouteKeyName()
    {
        return 'tag_slug';
    }
}

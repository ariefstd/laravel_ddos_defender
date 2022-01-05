<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class Meta extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'metas';
    protected $fillable = ['meta_page', 'meta_title', 'meta_slug', 'meta_description', 'meta_keyword', 'is_active'];

    public function scopeSearch($query, $title)
    {
        return $query->where('meta_page', 'LIKE', "%{$title}%");
    }
    public function getRouteKeyName()
    {
        return 'meta_slug';
    }
}

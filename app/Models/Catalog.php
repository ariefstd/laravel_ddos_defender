<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'catalogs';
    protected $fillable = ['catalog_name', 'catalog_slug', 'catalog_file', 'catalog_seq', 'is_active'];

    public function scopeSearch($query, $name)
    {
        return $query->where('catalog_name', 'LIKE', "%{$name}%");
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
        return 'catalog_slug';
    }
}

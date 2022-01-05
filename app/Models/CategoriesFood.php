<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesFood extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'food_categories';
    protected $fillable = ['food_name', 'food_slug', 'food_seq', 'food_thumbnail', 'is_active'];

    public function scopeOnlyParent($query)
    {
        return $query->whereNull('id');
    }

    public function scopeSearch($query, $title)
    {
        return $query->where('food_name', 'LIKE', "%{$title}%");
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
        return 'food_slug';
    }
}

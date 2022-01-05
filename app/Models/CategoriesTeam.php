<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesTeam extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'categories_teams';

    protected $fillable = ['category_name', 'category_slug', 'is_active'];

    public function scopeSearch($query, $title)
    {
        return $query->where('category_name', 'LIKE', "%{$title}%");
    }

    public function teams()
    {
        return $this->hasMany('App\Models\Team');
    }

    public function getRouteKeyName()
    {
        return 'category_slug';
    }
}

<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'teams';

    protected $fillable = ['category_id', 'team_name', 'team_slug', 'team_seq', 'team_position', 'team_image', 'team_desc', 'is_active'];

    public function scopeSearch($query, $name)
    {
        return $query->where('team_name', 'LIKE', "%%{$name}%");
    }

    public function category()
    {
        return $this->belongsTo(CategoriesTeam::class);
    }

    public function getRouteKeyName()
    {
        return 'team_slug';
    }
}

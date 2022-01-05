<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'regions';

    protected $fillable = ['city_id', 'region_name',  'region_slug', 'is_active'];

    public function scopeSearch($query, $name)
    {
        return $query->where('region_name', 'LIKE', "%%{$name}%");
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function markets()
    {
        return $this->hasMany(Market::class);
    }

    public function stalls()
    {
        return $this->hasMany(Stall::class);
    }

    public function getRouteKeyName()
    {
        return 'region_slug';
    }
}

<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'cities';

    protected $fillable = ['city_name', 'city_slug', 'is_active'];

    public function scopeSearch($query, $name)
    {
        return $query->where('city_name', 'LIKE', "%%{$name}%");
    }

    public function regions()
    {
        return $this->hasMany('App\Models\Region');
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
        return 'city_slug';
    }
}

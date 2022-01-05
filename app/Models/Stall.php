<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class Stall extends Model
{
    use HasFactory;
    protected $table = 'stalls';
    use Blameable;
    protected $fillable = ['city_id', 'region_id', 'market_id', 'stall_name', 'stall_slug', 'stall_address', 'stall_cover', 'stall_desc', 'stall_operational', 'stall_phone', 'stall_wa', 'stall_iframe', 'stall_gmap', 'is_active'];

    public function scopeSearch($query, $name)
    {
        return $query->where('stall_name', 'LIKE', "%%{$name}%");
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function categories()
    {
        return $this->belongsToMany(CategoriesFood::class, 'food_stall', 'stall_id', 'food_id')->withTimestamps();
    }

    public function photos()
    {
        return $this->hasMany(StallsPhoto::class);
    }

    public function getRouteKeyName()
    {
        return 'stall_slug';
    }
}

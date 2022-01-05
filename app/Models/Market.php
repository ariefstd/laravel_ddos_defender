<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class Market extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'markets';

    protected $fillable = ['city_id', 'region_id', 'market_name',  'market_slug',  'market_thumbnail',  'market_address', 'market_lat', 'market_long',  'market_phone',  'market_wa',  'market_gmap', 'is_active'];

    public function scopeSearch($query, $name)
    {
        return $query->where('market_name', 'LIKE', "%%{$name}%");
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function stalls()
    {
        return $this->hasMany(Stall::class);
    }

    public function getRouteKeyName()
    {
        return 'market_slug';
    }
}

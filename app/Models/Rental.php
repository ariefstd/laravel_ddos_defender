<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'rentals';
    protected $fillable = [
        'city_id',
        'region_id',
        'market_id',
        'rental_name',
        'rental_slug',
        'rental_address',
        'rental_cover',
        'rental_desc',
        'rental_phone',
        'rental_wa',
        'rental_price',
        'rental_posisi',
        'rental_size',
        'rental_iframe',
        'rental_gmap',
        'is_recommended',
        'is_active'
    ];

    public function scopeSearch($query, $name)
    {
        return $query->where('rental_name', 'LIKE', "%%{$name}%");
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

    public function photos()
    {
        return $this->hasMany(RentalPhoto::class);
    }

    public function getRouteKeyName()
    {
        return 'rental_slug';
    }
}

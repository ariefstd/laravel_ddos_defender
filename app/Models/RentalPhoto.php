<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalPhoto extends Model
{
    use HasFactory;
    protected $table = "rental_photos";
    protected $fillable = ['rental_id', 'filename'];

    public function rental()
    {
        return $this->belongsTo(RentalKios::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StallsPhoto extends Model
{
    use HasFactory;
    protected $table = "stalls_photos";
    protected $fillable = ['stall_id', 'filename'];

    public function stall()
    {
        return $this->belongsTo(Stall::class);
    }
}

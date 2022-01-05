<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    use Blameable;
    protected $fillable = ['image', 'stall_id', 'is_active'];

    public function stalls()
    {
        return $this->belongsTo(Stall::class);
    }
}

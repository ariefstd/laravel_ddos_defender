<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class Partner extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'partners';
    protected $fillable = ['partner_name', 'partner_slug', 'partner_logo', 'partner_seq', 'partner_link', 'is_active'];

    public function scopeSearch($query, $title)
    {
        return $query->where('partner_name', 'LIKE', "%{$title}%");
    }
    public function getRouteKeyName()
    {
        return 'partner_slug';
    }
}

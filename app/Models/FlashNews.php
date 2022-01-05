<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class FlashNews extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'flash_news';
    protected $fillable = ['news_name', 'news_slug', 'is_active'];

    public function scopeOnlyParent($query)
    {
        return $query->whereNull('id');
    }

    public function scopeSearch($query, $title)
    {
        return $query->where('news_name', 'LIKE', "%{$title}%");
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function getRouteKeyName()
    {
        return 'news_slug';
    }
}

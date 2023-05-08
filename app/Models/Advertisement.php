<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_link',
        'ad_pic',
    ];

    public function getAdPicUrlAttribute()
    {
        return asset('storage/' . basename($this->attributes['ad_pic']));
    }
}

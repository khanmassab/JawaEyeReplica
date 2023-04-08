<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'poster',
        'title',
        'duration',
        'release_time',
        'introduction',
        'actor_image',
        'description',
        'price',
        'sheets_per_ticket',
        'instructions',
        'income',
        'catalogue',
    ];

}

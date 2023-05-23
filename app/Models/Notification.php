<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'notification_text'
    ];

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y H:i', strtotime($value));
    }
}

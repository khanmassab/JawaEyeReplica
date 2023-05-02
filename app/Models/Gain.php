<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gain extends Model
{
    use HasFactory;
    

    protected $fillable = ['user_id', 'personal_gains', 'team_earning', 'ticket_quota'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'amount',
        'sender_binance',
        'binance_link',
        'proof_screenshot',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approve()
    {
        $this->status = 'approved';
        $this->save();

        $balance = $this->user->balance()->first();
        if ($balance) {
            $balance->balance += $this->amount;
            $balance->save();
        } else {
            $balance = new Balance;
            $balance->user_id = $this->user_id;
            $balance->balance = $this->amount;
            $balance->save();
        }
    }



    public function decline()
    {
        $this->status = 'declined';
        $this->save();
    }

    
}

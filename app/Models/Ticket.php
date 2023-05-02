<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'movie_id',
        'quantity',
        'amount',
        'booked_at',
        'expiry_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function returnProfit()
    {
        // Check if ticket is expired
        if (!$this->isExpired()) {
            return;
        }

        // Calculate profits
        $price = $this->amount;
        $profit = $price * 0.02;
        $teamEarning = $price * 0.0004;

        // Update user gains
        $gains = $this->user->gains()->firstOrNew([]);
        $gains->ticket_quota -= $profit;
        $gains->personal_gains += $profit;
        $gains->team_earning += $teamEarning;
        $gains->save();

        // Update user balance
        $this->user->balance += $price + $profit;
        $this->user->save();
    }
}


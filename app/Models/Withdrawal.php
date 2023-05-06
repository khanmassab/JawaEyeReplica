<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

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
            $balance->balance -= $this->withdrawal_amout;
            $balance->save();
        } else {
            $balance = new Balance;
            $balance->user_id = $this->user_id;
            $balance->balance = $this->withdrawal_amout;
            $balance->save();
        }

    }

    public function decline()
    {
        $this->status = 'declined';
        $this->save();
    }
}

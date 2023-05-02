<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    public function approve()
    {
        $this->status = 'apporoved';
        $this->save();

        $balance = $this->user->balance()->first();
        if ($balance) {
            $balance->balance -= $this->amout;
            $balance->save();
        } else {
            $balance = new Balance;
            $balance->user_id = $this->user_id;
            $balance->balance = $this->amout;
            $balance->save();
        }
    }

    public function decline()
    {
        $this->status = 'declined';
        $this->save();
    }
}

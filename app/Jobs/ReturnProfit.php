<?php

namespace App\Jobs;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReturnProfit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;
    protected $userReferer;

    /**
     * Create a new job instance.
     *
     * @param Ticket $ticket
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Add profit to user's balance
        $user = $this->ticket->user;
        $profit = $this->ticket->price +($this->ticket->price * 0.2) ;
        $user->balance->balance += $profit;
        $user->balance->save();

        // $userReferer = $this->userReferer;
        // $refererGain = $userReferer->gain->balance;
    }
}

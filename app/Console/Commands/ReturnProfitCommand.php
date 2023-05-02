<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ticket;

class ReturnProfitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:return-profit-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
        public function handle()
    {
        $ticketId = $this->argument('ticketId');
        $ticket = Ticket::find($ticketId);

        // $user

        if (!$ticket) {
            return;
        }

        $user = $ticket->user;
        $price = $ticket->amount;
        $profit = $price * 0.02;

        $user->balance += $price + $profit;
        $user->save();

        $ticket->delete();
    }
}

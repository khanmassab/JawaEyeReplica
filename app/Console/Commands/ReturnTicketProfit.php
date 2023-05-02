<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ticket;

class ReturnTicketProfit extends Command
{
    protected $signature = 'tickets:return-profit {ticketId} {--schedule=now}';

    protected $description = 'Return profits from a ticket after 24 hours';

    public function handle()
    {
        $ticketId = $this->argument('ticketId');
        $scheduleTime = $this->option('schedule');

        $ticket = Ticket::find($ticketId);
        if (!$ticket) {
            $this->error('Ticket not found');
            return;
        }

        $job = (new \App\Jobs\ReturnTicketProfit($ticket))
            ->delay($scheduleTime);

        dispatch($job);

        $this->info('Ticket profit return job dispatched successfully');
    }
}


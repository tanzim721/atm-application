<?php

namespace App\Console\Commands;

use Illuminate\Support\Arr;
use App\Jobs\TransferMoneyJob;
use Illuminate\Console\Command;

class GenerateQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-queue';

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
        for ($i = 1; $i <= 10; $i++) {
            $amount = rand(50, 150);
            $queue = Arr::random(['default', 'custom'], 1)[0];
            echo "Dispatching job with amount: $amount to queue: $queue\n";
            dispatch(new TransferMoneyJob($amount))->onQueue($queue);
        }
        echo "All jobs have been dispatched.\n";
    }
}

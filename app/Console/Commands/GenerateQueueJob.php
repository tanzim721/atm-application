<?php

namespace App\Console\Commands;

use App\Jobs\SendMailJob;
use Illuminate\Console\Command;

class GenerateQueueJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-queue-job';

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
        for ($i = 1; $i <= 30; $i++) {
            sleep(4);
            echo "Dispatching email job for user $i\n";
            dispatch(new SendMailJob($i))->onQueue('emails');
        }   
    }
}

<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransferMoneyJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;
    private $amount;

    /**
     * Create a new job instance.
     */
    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->amount > 100 && $this->attempts() < 3) {
            throw new \Exception("{$this->amount} Failed to transfer money. Amount exceeds limit.");
        }
        echo "Transferring amount: " . $this->amount . "$this->attempts()\n";
    }

    // public function failed($exception)
    // {
    //     Mail::send([], [], function($msg){
    //         $msg->to('tanzim@gmail.com')
    //             ->subject('Transfer Money Job Failed')
    //             ->html('The transfer money job has failed. Please check the system.');
    //     });
    // }
}

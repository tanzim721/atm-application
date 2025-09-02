<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccessMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMailJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public $request;

    /**
     * Create a new job instance.
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->request . '@gmail.com')->send(new RegistrationSuccessMail((object)[
            'name' => 'User ' . $this->request,
            'email' => $this->request . '@gmail.com'
        ]));
        echo "Email sent to user " . $this->request . "\n";      
    }
}

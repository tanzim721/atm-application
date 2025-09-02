<?php

namespace App\Jobs;

use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendOtpJob implements ShouldQueue
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
        // Mail::to(session('email'))->send(new SendOtpMail());

        Mail::to($this->request->email)->send(new SendOtpMail($this->request));   
    }
}

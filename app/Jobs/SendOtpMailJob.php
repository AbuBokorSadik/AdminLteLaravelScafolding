<?php

namespace App\Jobs;

use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendOtpMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $otp;

    public function __construct($user, $otp)
    {
        $this->user = $user;
        $this->otp = $otp;
    }

    public function middleware()
    {
        return [new WithoutOverlapping($this->user->id)];
    }

    public function handle()
    {
        Mail::to($this->user->email)->send(new OtpMail($this->user, $this->otp));
    }
}

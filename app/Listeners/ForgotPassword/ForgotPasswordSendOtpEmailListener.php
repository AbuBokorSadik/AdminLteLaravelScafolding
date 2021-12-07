<?php

namespace App\Listeners\ForgotPassword;

use App\Events\ForgotPassword\ForgotPasswordEvent;
use App\Jobs\SendOtpMailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ForgotPasswordSendOtpEmailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ForgotPasswordEvent $event)
    {
        // dd($event);
        SendOtpMailJob::dispatch($event->user, $event->otp)->delay(now()->addSeconds(15));
    }
}

<?php

namespace App\Traits;

use App\Mail\OtpMail;
use App\Models\Otp;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

trait OtpTrait
{

    public function generate_otp()
    {
        $otp = 123456;
        if (App::environment('production')) {
            $otp = mt_rand(100000, 999999);
        }

        return $otp;
    }

    public function user_otp($user, $purpose, $request)
    {
        // dd($request->ip());
        $otp = $this->generate_otp();

        Otp::create([
            'identity' => $user->email,
            'otp' => $otp,
            'purpose' => $purpose,
            'ip_address' => $request->ip(),
            'status' => 0,
        ]);

        $this->send_mail($user, $otp);
        
    }

    public function send_mail($user, $otp)
    {
        Mail::to($user->email)->send(new OtpMail($user, $otp));
    }
}

<?php
namespace App\Traits;

use App\Mail\TwoFactorOTPMail;
use Illuminate\Support\Facades\Mail;
use PragmaRX\Google2FA\Google2FA;

trait HelperTrait
{


    public function sendOTPMail($mail, $two_factor_otp)
    {
        try {
            Mail::to($mail)->send(new TwoFactorOTPMail([
                'code' => $two_factor_otp,
           ]));
        } catch (\Exception $th) {
            //throw $th;
            auth()->logout();
            return $th->getMessage();
        }
        return "success";
    }

    function otp_generate()
    {
        $google2fa = new Google2FA();
        $otp_secret = $google2fa->generateSecretKey();
        $one_time_password = $google2fa->getCurrentOtp($otp_secret);

        return $one_time_password;
    }
}

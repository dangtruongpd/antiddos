<?php
namespace App\Validators;

use Illuminate\Support\Facades\Http;

class ReCaptcha
{
    public function validate($attribute, $value, $parameters, $validator){

        $secretKey = env('GOOGLE_RECAPTCHA_SECRET', '6Lc-UPsgAAAAANPm6cSPjhTYbgI6yYFI8DSPBf1O');
        $recaptchaApiUrl = config('app.recaptcha_api_url');
        $userIP = request()->ip();

        $res = Http::asForm()->post($recaptchaApiUrl, [
            'secret' => $secretKey,
            'response' => $value,
            'remoteip' =>   $userIP
        ]);

        $body = json_decode($res->body());

        if (!$body->success){
            session()->flash('recaptcha_failed', 'Recaptcha failed! Please try again later.');
        }

        return $body->success;
    }
}

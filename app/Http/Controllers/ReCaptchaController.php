<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormReCaptcha;
use App\Models\History;

class ReCaptchaController extends Controller
{

    public function __construct()
    {
        $this->history = new History;
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function showCaptcha()
    {
        return view('form');
    }

    /**
     * 
     * @param \Illuminate\Http\Request $req
     * @return \Illuminate\Http\Response
     */
    public function captcha(FormReCaptcha $req)
    {
        $this->history->updateCount($req->ip());

        return redirect()->route('home');
    }
}
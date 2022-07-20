<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->history = new History;
        $this->middleware('check_ip');
    }

    public function index(Request $request)
    {
        $ip = $request->ip();

        if($this->history->isIPExists($ip)){

            $isStored = $this->history->updateHistory($ip);

        }else{

            $isStored = $this->history->addNewHistory($ip);

        }
    }
}

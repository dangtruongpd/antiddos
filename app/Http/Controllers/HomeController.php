<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\History;
use App\Models\Option;

class HomeController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        $this->middleware('check_ip');
        $this->history = new History;
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $all = $this->history->all();

        $requests = Option::where('key', 'requests')->get()->first()->value;

        $scope = Option::where('key', 'scope')->get()->first()->value;

        $unit = Option::where('key', 'unit')->get()->first()->value;

        return view('home', [
            'all' => $all,
            'requests' => $requests,
            'scope' => $scope,
            'unit' => $unit
        ]);
    }

    /**
     * 
     * @param \Illuminate\Http\Request $req
     * @return \Illuminate\Http\Response
     */
    public function updateConfig(Request $req)
    {  
        $requests = Option::where('key', 'requests')->get()->first();

        $requests->value = $req->requests;

        $requests->save();

        $scope = Option::where('key', 'scope')->get()->first();

        $scope->value = $req->scope;

        $scope->save();

        $unit = Option::where('key', 'unit')->get()->first();

        $unit->value = $req->unit;

        $unit->save();

        return redirect()->back();
    }

    /**
     * 
     * @param \Illuminate\Http\Request $req
     * @return \Illuminate\Http\Response
     */
    public function storeConfig(Request $req)
    {
        $all = $this->history->all();

        return view('home', ['all' => $all]);
    }
}

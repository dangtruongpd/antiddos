<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        $requests = Option::where('key', 'requests')->first()->value;

        $scope = Option::where('key', 'scope')->first()->value;

        $unit = Option::where('key', 'unit')->first()->value;

        return view('home', [
            'all' => $all,
            'requests' => $requests,
            'scope' => $scope,
            'unit' => $unit,
        ]);
    }

    /**
     *
     * @param \Illuminate\Http\Request $req
     * @return \Illuminate\Http\Response
     */
    public function updateConfig(Request $req)
    {
        $requests = Option::where('key', 'requests')->first();

        $requests->value = $req->requests;

        $requests->save();

        $scope = Option::where('key', 'scope')->first();

        $scope->value = $req->scope;

        $scope->save();

        $unit = Option::where('key', 'unit')->first();

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

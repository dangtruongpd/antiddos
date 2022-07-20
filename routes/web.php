<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HistoryController@index');

Route::prefix('curl')->group(function() {

    Route::get('get', function() {
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_RETURNTRANSFER => TRUE,
        //     CURLOPT_URL => 'https://developers.google.com/static/search/apis/ipranges/googlebot.json?hl=vi',
        //     CURLOPT_USERAGENT => 'Truong vd',
        //     CURLOPT_SSL_VERIFYPEER => FALSE
        // ));
    
        // $resp = curl_exec($curl);
    
        // //Dữ liệu thời tiết ở dạng JSON
        
        // $weather = json_decode($resp);
    
        // dd($weather->prefixes);

        $response = Http::get('https://developers.google.com/static/search/apis/ipranges/googlebot.json?hl=vi');

        dd(json_decode($response->body())->prefixes);
    });

});
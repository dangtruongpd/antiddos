<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GetBotIpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        $ipUrl = config('app.bot_ip_urls');

        $ipList = [];

        foreach ($ipUrl as $url) {
            $response = Http::get($url);

            $data = json_decode($response->body());
    
            $data = array_values($data->prefixes);

            foreach ($data as $value) {
                if(!empty($value->ipv6Prefix))
                    array_push($ipList, $value->ipv6Prefix);
                if(!empty($value->ipv4Prefix))
                    array_push($ipList, $value->ipv4Prefix);
            }
        }

        file_put_contents("ip_list.txt", serialize($ipList));
    }

    /**
     *
     *
     *
     */
    public function getBotIpList()
    {
        if(file_exists("ip_list.txt")){
            $ipList = unserialize(file_get_contents("ip_list.txt"));

            dd($ipList);
        }
    }

    /**
     *
     *
     *
     */
    public function deleteBotIpList()
    {
        if(file_exists("ip_list.txt")){
            file_put_contents("ip_list.txt", "");
        }
    }
}

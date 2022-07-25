<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\DB;
use App\Constants\Constants;
use App\Models\Option;

class CheckIp
{
    public function __construct()
    {
        $this->history = new History;
        // $this->middleware('check_ip');
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();

        $requests = Option::where('key', 'requests')->get()->first()->value;

        $scope = Option::where('key', 'scope')->get()->first()->value;

        $unit = Option::where('key', 'unit')->get()->first()->value;

        $scopeTime = Constants::get_constant($unit) * $scope;

        $history = $this->history->findByIP($ip);

        if(file_exists("ip_list.txt")){
            $ipList = unserialize(file_get_contents("ip_list.txt"));

            if(in_array($ip, $ipList))
                return $next($request);
        }
        
        if($history!=null){
            
            $gap = strtotime(date("Y-m-d H:i:s")) - strtotime($history->first_time);

            if($gap > $scopeTime){
                $history->resetHistory();

            }else{
                if($history->count>=$requests){
                    return redirect()->route('captcha.show');

                }else{
                    $history->updateHistory();

                }
            }
        }else{
            $this->history->addNewHistory($ip);
        }

        return $next($request);
    }
}

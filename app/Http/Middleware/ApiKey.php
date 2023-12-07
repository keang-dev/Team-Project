<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
// use Jenssegers\Agent\Agent;
class ApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        // $agent = new Agent;

        $type = base64Decode($request->header('type'));
        $api_key = base64Decode($request->header('api_key'));

        if(DB::table('api_keys')->where(['key' => $type, 'api_key' => $api_key, 'active' => 1])->count() == 0){
            if($type == 'web'){
                if(!$agent->is('Windows') || !$agent->is('OS X')){
                    return response()->json(['status' => 403, 'sms' => 'No key access !!!']);
                }
            }
            else if($type == 'android'){
                if(!$agent->is('android')){
                    return response()->json(['status' => 403, 'sms' => 'No key access !!!']);
                }
            }
            else { //iphone
                if(!$agent->is('iphone')){
                    return response()->json(['status' => 403, 'sms' => 'No key access !!!']);
                }
            }
        }
        return $next($request);
    }
}
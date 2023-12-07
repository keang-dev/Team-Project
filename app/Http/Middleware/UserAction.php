<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class UserAction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $data = [
            'request_url' => request()->url(),
            'user_id' => auth()->check() ? auth()->user()->id : 0,
            'device_info' => request()->header('user-agent'),
            'client_ip' => $_SERVER['REMOTE_ADDR'],
            'created_at' => Carbon::now()
        ];
        DB::table('user_actions')->insert($data);

        $white_lists = DB::table('white_lists')->where('active', 1)->where('address', $_SERVER['REMOTE_ADDR'])->count();
        
        DB::table('user_actions')
        ->whereDate('created_at', '<=', date('Y-m-d', strtotime(Carbon::now()->subDays(7))))
        ->delete();

        if($white_lists > 0){
            return $next($request);
        }else{
            return redirect()->route('no-permission');
        }
       
    }
}

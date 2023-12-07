<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission,$action): Response
    {
        $user_id = request()->header("user_id");
        $user = DB::table('users')->find($user_id);

        // if(!checkPermission($permission,$action)){
        //     audit('is_no_permission','is_'.$action,$user);
        //     return response()->json(['status' => 'no_permission', 'sms' => 'You are no permission to access this path !!!']);
        // }
        // audit('','is_'.$action,$user);

        if($request->lat && $request->lng){
            DB::table('users')->where('id',$request->header('user_id'))->update([
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);
        }

        return $next($request);
    }
}
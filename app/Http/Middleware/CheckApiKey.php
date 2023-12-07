<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiKey;

class CheckApiKey
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
        if(array_key_exists('apikey', $request->header())){
            $key = $request->header()['apikey'][0];
            $count = ApiKey::where('key', $key)->count();
            if($count > 0){
                return $next($request);
            }
        }
        
        return response()->json([
            'massage' => 'error'
        ]);
        
        
    }
}

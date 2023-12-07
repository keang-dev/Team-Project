<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class UserActionController extends Controller
{
    public function index()
    {
        // dd(request());
        $dateS=Carbon::now()->subDays(1)->format('Y-m-d');
        $data['user_actions'] = DB::table('user_actions')
            ->Join('users', 'users.id', 'user_actions.user_id')
            ->whereDate('user_actions.created_at', '>', $dateS)
            ->select(
                'user_actions.*',
                'users.name as user_name',
            )
            ->orderBy('user_actions.created_at', 'DESC')
            ->paginate(config('app.row'));
     
        return view('users.user_action', $data);
    }
    public function user_login()
    {
        $dateS=Carbon::now()->subDays(7)->format('Y-m-d');
        $data['user_logins'] = DB::table('user_logins')
        // ->Join('users', 'user_logins.user_id', 'users.id')
        ->whereDate('user_logins.created_at', '>', $dateS)
        ->whereNotNull('user_logins.email')
            ->select(
                'user_logins.*',
               'user_logins.email as user_email',
            )
            ->orderBy('user_logins.created_at', 'DESC')
            ->get();
            $data['user_logout'] = DB::table('user_logins')
            ->Join('users', 'user_logins.user_id', 'users.id')
            ->whereDate('user_logins.created_at', '>', $dateS)
            ->where('user_logins.user_id','>=', 1)
                ->select(
                    'user_logins.*',
                   'users.name as user_name',
                )
                ->orderBy('user_logins.created_at', 'DESC')
                ->get();
        return view('users.user_login', $data);
      
    }
    
}
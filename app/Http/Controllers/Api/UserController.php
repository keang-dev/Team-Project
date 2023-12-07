<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Hash;

class UserController extends Controller
{
    public function index(Request $r){
        $user_id = request()->header('user_id');
        if($r->user_id == 0){
            $user = User::join('roles','roles.id','users.role_id')
                    ->where('created_by',$user_id)
                    ->select('users.*','roles.name as role_name')->paginate(2);
        } else {
            // $user = User::find($r->user_id);
        }
        $data['roles'] = DB::table('roles')->get();
        $data['user'] = $user;

        return $this->shareData(['data' => $data]);
    }
    public function store(Request $r){
        try {
            $user = new User;
            $user->name = $r->name;
            $user->password = Hash::make($r->password);
            $user->role_id = $r->role_id;
            $user->email = $r->email;
            $user->created_by = request()->header('user_id');
            $user->save();

            return response()->json(['status' => 'success', 'sms' => 'បញ្ចូលបានសម្រេច!!!']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }

    public function update(Request $r){
        try {
            $user = User::find($r->user_id);
            $user->name = $r->name;
            $user->role_id = $r->role_id;
            $user->email = $r->email;

            if($r->password){
                $user->password = Hash::make($r->password);
            }

            $user->save();

            return response()->json(['status' => 'success', 'sms' => 'Update Successfully']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }
    public function delete(Request $r){
        try {
            $user = User::find($r->user_id)->delete();
            return response()->json(['status' => 'success', 'sms' => 'Delete Successfully']);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }
    }
}
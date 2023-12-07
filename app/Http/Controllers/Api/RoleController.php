<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Role;

class RoleController extends Controller
{
    public function index(Request $r){
        if($r->role_id == 0){
            $role = Role::query()->select('*')->paginate(10);
        } else {
            $role = Role::find($r->role_id);
        }
        $data['role'] = $role;

        return response()->json(['data' => $data]);
    }
    public function store(Request $r){
        try {
            $role = new Role;
            $role->name = $r->name;
            // $role->note = $r->note;
            $role->save();

            return response()->json(['status' => 'success', 'sms' => 'បញ្ចូលបានសម្រេច!!!']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }

    public function update(Request $r){
        try {
            $role = Role::find($r->role_id);
            $role->name = $r->name;
            // $role->note = $r->note;

            $role->save();

            return response()->json(['status' => 'success', 'sms' => 'Update Successfully']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }
    public function delete(Request $r){
        try {
            $role = Role::find($r->role_id)->delete();
            return response()->json(['status' => 'success', 'sms' => 'Delete Successfully']);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }
    }
}
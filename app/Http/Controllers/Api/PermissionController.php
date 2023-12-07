<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Permission;
use App\Models\Unit;

class PermissionController extends Controller
{
    public function index(Request $r){
        if($r->permission_id == 0){
            $permission = Permission::query()->select('*')->paginate(100);
        } else {
            $permission = Permission::find($r->permission_id);
        }
        $data['permission'] = $permission;

        return response()->json(['data' => $data]);
    }
  
    public function store(Request $r){
        try {
            $permission = new Permission;
            $permission->name = $r->name;
            $permission->key = $r->key;
            $permission->save();

            return response()->json(['status' => 'success', 'sms' => 'បញ្ចូលបានសម្រេច!!!']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }

    public function update(Request $r){
        try {
            $permission = Permission::find($r->permission_id);
            $permission->name = $r->name;
            $permission->key = $r->key;
            $permission->save();

            return response()->json(['status' => 'success', 'sms' => 'Update Successfully']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }
    public function delete(Request $r){
        try {
            $role = Permission::find($r->permission_id)->delete();
            return response()->json(['status' => 'success', 'sms' => 'Delete Successfully']);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }
    }
}
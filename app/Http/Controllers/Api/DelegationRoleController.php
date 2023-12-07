<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Delegation_role;
class DelegationRoleController extends Controller
{
    public function index(Request $r){
        if($r->delegation_role_id == 0){
            $delegation_role = delegation_role::query()->select('*')->where('active', 1)->paginate(100);
        } else {
            $delegation_role = delegation_role::find($r->delegation_role_id);
        }
        $data['delegation_role'] = $delegation_role;
        // return $this->shareData(['data' => $data]);
        return response()->json(['data' => $data]);
    }
    public function store(Request $r){
        try {
            $delegation_role = new delegation_role;
            $delegation_role->delegationrole_name_kh = $r->delegationrole_name_kh;
            $delegation_role->delegationrole_name_en = $r->delegationrole_name_en;
            $delegation_role->save();

            return response()->json(['status' => 'success', 'sms' => 'បញ្ចូលបានសម្រេច!!!']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }

    public function update(Request $r){
        try {
            $delegation_role = delegation_role::find($r->delegation_role_id);
            $delegation_role->delegationrole_name_kh = $r->delegationrole_name_kh;
            $delegation_role->delegationrole_name_en = $r->delegationrole_name_en;

            $delegation_role->save();

            return response()->json(['status' => 'success', 'sms' => 'Update Successfully']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }
    public function delete(Request $r){
        try {
            $delegation_role = delegation_role::find($r->delegation_role_id);
            $delegation_role->active = 0;
            $delegation_role->save();
            return response()->json(['status' => 'success', 'sms' => 'លុបបានជោគជ័យ']);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }
    }
}
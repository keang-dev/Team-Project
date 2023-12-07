<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Delegation;
class DelegationController extends Controller
{
    public function index(Request $r){
        if($r->delegation_id == 0){
            $delegation = delegation::query()->select('*')->where('active', 1)->paginate(100);
        } else {
            $delegation = delegation::find($r->delegation_id);
        }
        $data['delegation'] = $delegation;
        // return $this->shareData(['data' => $data]);
        return response()->json(['data' => $data]);
    }
    public function store(Request $req){
        try {
            $delegation = new delegation;
            $data['delegation_name_kh'] = $req->delegation_name_kh;
            $data['delegation_name_en'] = $req->delegation_name_en;
            $data['audit_id'] = $req->audit_id;
            $data['in_by'] = $req->in_by;
    
            $id = DB::table('delegations')->insertGetId($data);
            if($id)
            {
                $code= sprintf("%06d", $id). "AD";
                DB::table('delegations')
                    ->where('id', $id)
                    ->update(['delegation_code' =>$code]);  
              
            }

            return response()->json(['status' => 'success', 'sms' => 'បញ្ចូលបានសម្រេច!!!']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }

    public function update(Request $r){
        try {
            $delegation = Delegation::find($r->delegation_id);
            
            $delegation->delegation_name_kh = $r->delegation_name_kh;

            $delegation->save();

            return response()->json(['status' => 'success', 'sms' => 'Update Successfully']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }
    public function delete(Request $r){
        try {
            $delegation = delegation::find($r->delegation_id);
            $delegation->active = 0;
            $delegation->save();
            return response()->json(['status' => 'success', 'sms' => 'លុបបានជោគជ័យ']);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }
    }
}
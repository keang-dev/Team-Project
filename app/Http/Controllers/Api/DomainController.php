<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Domain;
class DomainController extends Controller
{
    public function index(Request $r){
        if($r->domain_id == 0){
            $domain = domain::query()->select('*')->where('active', 1)->paginate(100);
        } else {
            $domain = domain::find($r->domain_id);
        }
        $data['domain'] = $domain;
        // return $this->shareData(['data' => $data]);
        return response()->json(['data' => $data]);
    }
    public function update(Request $r){
        try {
            $domain = ApiKey::find($r->domain_id);
            $domain->domain_name_kh = $r->domain_name_kh;
          

            $domain->save();

            return response()->json(['status' => 'success', 'sms' => 'Update Successfully']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }
    public function delete(Request $r){
        try {
            $domain = Domain::find($r->domain_id);
            $domain->active = 0;
            $domain->save();
            return response()->json(['status' => 'success', 'sms' => 'InActive']);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }
    }
}
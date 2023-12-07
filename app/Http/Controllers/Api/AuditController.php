<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Audit;
use Carbon\Carbon;
class AuditController extends Controller
{
    public function index1(Request $r)
    {
     
        if($r->audit_id == 0){
            $audit = audit::query()
            ->select(
                'audits.*',
                'audits.id',
            )
            ->whereDate('created_at', '<=', $this->reverse_birthday(0))
            ->whereDate('created_at', '>=', $this->reverse_birthday(1))
            ->where('audit_active', 1)
            
            ->paginate(100);
        } else {
            $audit = audit::find($r->audit_id);
        }
       
        $data['audit'] = $audit;
        return response()->json(['data' => $data]);
    }
    public function edit(Request $r){
            $data['audits'] = DB::table('audits')->find($r->id);
            return response()->json(['data' => $data]);   
    }
    public function index(Request $r){
        if($r->audit_id == 0){
            $audit = audit::join('audit_types', 'audits.audit_code','=','audit_types.id')
            ->join('units', 'audits.unit_id','=','units.id')
            ->join('auditees', 'audits.auditee_id','=','auditees.id')

            ->select(
                'audits.*',
                'audit_types.audittype_name_kh',
                'units.unit_name_km',
                'auditees.auditee_name_kh',
            )
            ->where('audit_active', 1)
            ->paginate(100);
        } else {
            $audit = audit::find($r->audit_id);
        }
        $data['audit'] = $audit;
        $data['auditees']= DB::table('auditees')->where('auditees.active', 1)->get();
        $data['audit_types']= DB::table('audit_types')->where('audit_types.active', 1)->get();
        $data['units']= DB::table('units')->where('units.active', 1)->get();
        // return $this->shareData(['data' => $data]);
        return response()->json(['data' => $data]);
    }
    public function store(Request $req){
        try {
            $audit = new audit;
            $data['audit_name_kh'] = $req->audit_name_kh;
            $data['audittype_id'] = $req->audittype_id;
            $data['auditee_id'] = $req->auditee_id;
            $data['unit_id'] = $req-> unit_id;
            $data['auditperiod'] = $req->auditperiod;
            $data['in_by'] = $req->in_by;
            $id = DB::table('audits')->insertGetId($data);
            if($id)
            {
                $code= sprintf("%06d", $id). "WP";
                DB::table('audits')
                    ->where('id', $id)
                    ->update(['audit_code' =>$code]);  
              
            }

            return response()->json(['status' => 'success', 'sms' => 'បញ្ចូលបានសម្រេច!!!']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }
    public function delete(Request $r){
        try {
            $audit = audit::find($r->audit_id);
            $audit->audit_active = 0;
            $audit->save();
            return response()->json(['status' => 'success', 'sms' => 'លុបបានជោគជ័យ']);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }
    }
    // rek
    public function reverse_birthday( $years ){
        return date('Y-m-d', strtotime($years . 'years ago'));
    }
}
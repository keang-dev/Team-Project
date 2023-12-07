<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Audit_qa;
class AuditQAController extends Controller
{
    public function index(Request $r){
        if($r->audit_qa_id == 0){
            $audit_qa = audit_qa::query()->select('*')->where('active', 1)->paginate(100);
        } else {
            $audit_qa = audit_qa::find($r->audit_qa_id);
        }
        $data['audit_qa'] = $audit_qa;
        // return $this->shareData(['data' => $data]);
        return response()->json(['data' => $data]);
    }
    public function store(Request $r){
        try {
            $audit_qa = new audit_qa;
            $audit_qa->auditqa_name_kh = $r->auditqa_name_kh;
            $audit_qa->auditqa_name_en = $r->auditqa_name_en;

            $audit_qa->save();

            return response()->json(['status' => 'success', 'sms' => 'បញ្ចូលបានសម្រេច!!!']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }

    public function update(Request $r){
        try {
            $audit_qa = audit_qa::find($r->audit_qa_id);
            $audit_qa->auditqa_name_kh = $r->auditqa_name_kh;
            $audit_qa->auditqa_name_en = $r->auditqa_name_en;

            $audit_qa->save();

            return response()->json(['status' => 'success', 'sms' => 'Update Successfully']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }
    public function delete(Request $r){
        try {
            $audit_qa = audit_qa::find($r->audit_qa_id);
            $audit_qa->active = 0;
            $audit_qa->save();
            return response()->json(['status' => 'success', 'sms' => 'លុបបានជោគជ័យ']);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }
    }
}
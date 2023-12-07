<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AuditQAReviewController extends Controller
{
    public function index(Request $req){
       
        if($req->ajax()){
            $data = DB::table('audit_qareviews')
            ->join('audits', 'audit_qareviews.audit_id','=','audits.id')
            ->join('audit_steps', 'audit_qareviews.auditstep_id','=','audit_steps.id')
            ->join('audit_qas', 'audit_qareviews.auditqa_id','=','audit_qas.id')
            ->join('staffs', 'audit_qareviews.audit_qareview_by','=','staffs.id')

            ->select(
                'audit_qareviews.*',  
                'audit_steps.auditstep_name_kh',
                'audits.audit_code',
                'audit_qas.auditqa_name_kh',
        
                DB::raw("CONCAT(staffs.staff_first_name_km,' ', staffs.staff_last_name_km) as full_name"),
            )
            ->where('audit_qareviews.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                          $id = $row->id;
                          $btn_edit = btn_edit('audit_qareviews', 'province', 'update', $id);
                        $btn_delete = btn_delete('audit_qareviews', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                 
                  
                    
                ->rawColumns(['action'])
                   ->make(true);     
        } 
        $data['audit_steps']= DB::table('audit_steps')->where('audit_steps.active', 1)->get();
        $data['audits']= DB::table('audits')->where('audits.audit_active', 1)->get();
        $data['audit_qas']= DB::table('audit_qas')->where('audit_qas.active', 1)->get();
        $data['staffs']= DB::table('staffs')->where('staffs.active', 1)->get();


     
        return view('options_02.audit_qa_review.index', $data); 
    }
}
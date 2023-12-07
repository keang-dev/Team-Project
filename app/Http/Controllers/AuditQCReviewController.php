<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AuditQCReviewController extends Controller
{
    public function index(Request $req){
       
        if($req->ajax()){
            $data = DB::table('audit_qcreviws')
            ->join('audits', 'audit_qcreviws.audit_id','=','audits.id')
            ->join('audit_steps', 'audit_qcreviws.auditstep_id','=','audit_steps.id')
            ->join('audit_qcs', 'audit_qcreviws.auditqc_id','=','audit_qcs.id')
            ->join('staffs', 'audit_qcreviws.audit_qcreview_by','=','staffs.id')

            ->select(
                'audit_qcreviws.*',  
                'audit_steps.auditstep_name_kh',
                'audits.audit_code',
                'audit_qcs.auditqc_name_kh',
        
                DB::raw("CONCAT(staffs.staff_first_name_km,' ', staffs.staff_last_name_km) as full_name"),
            )
            ->where('audit_qcreviws.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                          $id = $row->id;
                          $btn_edit = btn_edit('audit_qcreviws', 'province', 'update', $id);
                        $btn_delete = btn_delete('audit_qcreviws', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                 
                  
                    
                ->rawColumns(['action'])
                   ->make(true);     
        } 
        $data['audit_steps']= DB::table('audit_steps')->where('audit_steps.active', 1)->get();
        $data['audits']= DB::table('audits')->where('audits.audit_active', 1)->get();
        $data['audit_qcs']= DB::table('audit_qcs')->where('audit_qcs.active', 1)->get();
        $data['staffs']= DB::table('staffs')->where('staffs.active', 1)->get();


     
        return view('options_02.audit_qc_review.index', $data); 
    }
}
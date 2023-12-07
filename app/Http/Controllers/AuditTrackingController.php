<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AuditTrackingController extends Controller
{
    public function index(Request $req){
       
        if($req->ajax()){
            $data = DB::table('audit_trackings')
            ->join('audits', 'audit_trackings.audit_id','=','audits.id')
            ->join('audit_steps', 'audit_trackings.auditstep_id','=','audit_steps.id')
            ->join('audit_process_status', 'audit_trackings.auditprocessstatus_id','=','audit_process_status.id')

            ->select(
                'audit_trackings.*',  
                'audits.audit_code',
                'audit_trackings.file_km',
                'audit_steps.auditstep_name_kh',
                'audit_process_status.auditprocessstatus_name_kh',  
            )
            ->where('audit_trackings.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                          $id = $row->id;
                          $btn_edit = btn_edit('audit_trackings', 'province', 'update', $id);
                        $btn_delete = btn_delete('audit_trackings', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                 
                    ->addColumn('file_km', function($row){
                        $pdf_url = auditreport_tracking_file($row->file_km);
                        return $row->file_km == NULL ? '<a class="btn btn-danger btnActive">មិនមានឯកាសារ</a>': '<a class="btn btn-success" href="'.$pdf_url.'" target="_blank">ទាញយក</a>';
                    })
                    
                ->rawColumns(['action', 'file_km'])
                   ->make(true);     
        } 
        $data['audit_steps']= DB::table('audit_steps')->where('audit_steps.active', 1)->get();
        $data['audits']= DB::table('audits')->where('audits.audit_active', 1)->get();
        $data['audit_process_status']= DB::table('audit_process_status')->where('audit_process_status.active', 1)->get();
     
        return view('options_02.audit_tracking.index', $data); 
    }
}
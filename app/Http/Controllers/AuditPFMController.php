<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AuditPFMController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('audit_pfms')
            ->join('audits', 'audit_pfms.audit_id','=','audits.id')
            ->join('audit_report_pfms', 'audit_pfms.auditreportpfm_id','=','audit_report_pfms.id')


            ->select(
                'audit_pfms.*',
                'audits.audit_code',
                'audit_report_pfms.auditreportpfm_name_kh',
            )
            ->where('audit_pfms.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('audit_pfms', 'province', 'update', $id);
                        $btn_delete = btn_delete('audit_pfms', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }
        $data['audits']= DB::table('audits')->where('audits.audit_active', 1)->get();
        $data['audit_report_pfms']= DB::table('audit_report_pfms')->where('audit_report_pfms.active', 1)->get();

        return view('options_02.audit_pfm1.index',$data);
    }
}
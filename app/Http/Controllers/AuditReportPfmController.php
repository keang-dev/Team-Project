<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AuditReportPfmController extends Controller
{
    public function index(Request $req){
       
      if($req->ajax()){
          $data = DB::table('audit_report_pfms')
          ->select(
              'audit_report_pfms.*',  
              'audit_report_pfms.file_km',  
          )
          ->where('audit_report_pfms.active', 1);
          return Datatables::of($data)
                  ->addIndexColumn()
                  ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('audit_report_pfms', 'province', 'update', $id);
                      $btn_delete = btn_delete('audit_report_pfms', 'province', 'delete', $id);
                      $btns = $btn_edit.' '.$btn_delete;
                      return $btns;
                  })
                  ->addColumn('is_default', function($row){
                      $is_checked = $row->is_default ? 'checked' : '';
                      $checkbox = "<input type='checkbox' value='$row->id' onchange='setDefault($row->id, this)' $is_checked>";
                      return $checkbox;
                  })
                  ->addColumn('file_km', function($row){
                      $pdf_url = auditreportpfm_file($row->file_km);
                      return $row->file_km == NULL ? '<a class="btn btn-danger btnActive">មិនមានឯកាសារ</a>': '<a class="btn btn-success" href="'.$pdf_url.'" target="_blank">ទាញយក</a>';
                  })
                  
              ->rawColumns(['action', 'is_default', 'file_km'])
                 ->make(true);     
      } 
   
      return view('options_01.audit_report_pfm.index'); 
  }
}
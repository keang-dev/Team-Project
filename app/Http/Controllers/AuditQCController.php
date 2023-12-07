<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables; 
class AuditQCController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('audit_qcs')
            ->select(
                'audit_qcs.*',
            )
            ->where('audit_qcs.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('audit_qcs', 'province', 'update', $id);
                        $btn_delete = btn_delete('audit_qcs', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }
        return view('options_01.audit_qc.index');
    }
}
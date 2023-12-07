<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AuditProcessStatusController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('audit_process_status')
            ->select(
                'audit_process_status.*',
            )
            ->where('audit_process_status.active', 1);

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('audit_process_status', 'province', 'update', $id);
                        $btn_delete = btn_delete('audit_process_status', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }
        return view('options_01.audit_process_status.index');
    }
}
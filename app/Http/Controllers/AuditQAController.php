<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AuditQAController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('audit_qas')
            ->select(
                'audit_qas.*',
            )
            ->where('audit_qas.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('audit_qas', 'province', 'update', $id);
                        $btn_delete = btn_delete('audit_qas', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }
        return view('options_01.audit_qa.index');
    }
}
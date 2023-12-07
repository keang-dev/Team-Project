<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AuditeeContactTypeController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('auditee_contact_types')
            ->select(
                'auditee_contact_types.*',
            )
            ->where('auditee_contact_types.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('auditee_contact_types', 'province', 'update', $id);
                        $btn_delete = btn_delete('auditee_contact_types', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }
        return view('options_01.auditee_contact_type.index');
    }
}
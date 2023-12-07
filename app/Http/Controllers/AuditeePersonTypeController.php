<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AuditeePersonTypeController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('auditee_person_types')
            ->select(
                'auditee_person_types.*',
            )
            ->where('auditee_person_types.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('auditee_person_types', 'province', 'update', $id);
                        $btn_delete = btn_delete('auditee_person_types', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }
        return view('options_01.auditee_person_type.index');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AuditeeController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('auditees')
            ->join('auditee_types', 'auditees.auditeetype_id','=','auditee_types.id')
            ->select(
                'auditees.*',
                'auditee_types.audittype_name_kh',
            )
            ->where('auditees.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('auditees', 'province', 'update', $id);
                        $btn_delete = btn_delete('auditees', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                    ->addColumn('is_default', function($row){
                        $is_checked = $row->is_default ? 'checked' : '';
                        $checkbox = "<input type='checkbox' value='$row->id' onchange='setDefault($row->id, this)' $is_checked>";
                        return $checkbox;
                    })
                ->rawColumns(['action', 'is_default'])
               	->make(true);
        }
        $data['auditee_types']= DB::table('auditee_types')->where('auditee_types.active', 1)->get();
        return view('options_02.auditee.index', $data);
    }
}
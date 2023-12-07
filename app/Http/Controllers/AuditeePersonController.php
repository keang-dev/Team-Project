<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AuditeePersonController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('auditee_persons')
            ->select(
                'auditee_persons.*',
            )
            ->where('auditee_persons.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('auditee_persons', 'province', 'update', $id);
                        $btn_delete = btn_delete('auditee_persons', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }
        return view('options_01.auditee_person.index');
    }
} 
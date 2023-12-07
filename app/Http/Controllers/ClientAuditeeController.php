<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class ClientAuditeeController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('client_auditees')
            ->join('clients', 'client_auditees.client_id','=','clients.id')
            ->join('auditees', 'client_auditees.auditee_id','=','auditees.id')
            ->select(
                'client_auditees.*',
                'clients.client_name_kh',
                'auditees.auditee_name_kh', 
            )
            ->where('client_auditees.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('client_auditees', 'province', 'update', $id);
                        $btn_delete = btn_delete('client_auditees', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }
        $data['clients']= DB::table('clients')->where('clients.active', 1)->get();
        $data['auditees']= DB::table('auditees')->where('auditees.active', 1)->get();
        return view('options_02.client_auditee.index', $data);
    }
}
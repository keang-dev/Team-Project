<?php

namespace App\Http\Controllers;
use DB;
use DataTables;
use Illuminate\Http\Request;

class ClientContactTypeController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('client_contact_types')
            ->select(
                'client_contact_types.*',
            )
            ->where('client_contact_types.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('client_contact_types', 'province', 'update', $id);
                        $btn_delete = btn_delete('client_contact_types', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }
        return view('options_01.client_contact_type.index');
    }
}
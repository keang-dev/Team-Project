<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class ClientController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('clients')
            ->join('client_types', 'clients.clienttype_id','=','client_types.id')
            ->select(
                'clients.*',
                'client_types.clienttype_name_kh',
            )
            ->where('clients.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('clients', 'province', 'update', $id);
                        $btn_delete = btn_delete('clients', 'province', 'delete', $id);
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
        $data['client_types']= DB::table('client_types')->where('client_types.active', 1)->get();
        return view('options_02.client.index', $data);
    }
}
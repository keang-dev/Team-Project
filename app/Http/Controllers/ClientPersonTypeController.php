<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class ClientPersonTypeController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('client_person_types')
            ->select(
                'client_person_types.*',
            )
            ->where('client_person_types.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('client_person_types', 'province', 'update', $id);
                        $btn_delete = btn_delete('client_person_types', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }
        return view('options_01.client_person_type.index');
    }
}
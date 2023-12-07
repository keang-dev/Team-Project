<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class ClientPersonController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('client_persons')
            ->select(
                'client_persons.*',
            )
            ->where('client_persons.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('client_persons', 'province', 'update', $id);
                        $btn_delete = btn_delete('client_persons', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }
        return view('options_01.client_person.index');
    }
}
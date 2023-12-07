<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class DomainController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('domains')
            ->select(
                'domains.*',
            )
            ->where('domains.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('domains', 'province', 'update', $id);
                        $btn_delete = btn_delete('domains', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }
        return view('options_01.domain.index');
    }
}
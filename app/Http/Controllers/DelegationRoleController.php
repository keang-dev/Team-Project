<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class DelegationRoleController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('delegation_roles')
            ->select(
                'delegation_roles.*',
                
            )
            ->where('delegation_roles.active', 1);

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('delegation_roles', 'province', 'update', $id);
                        $btn_delete = btn_delete('delegation_roles', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                     
                    })
                ->rawColumns(['action'])
               	->make(true);

        }
        return view('options_01.delegation_role.index');
    }
}
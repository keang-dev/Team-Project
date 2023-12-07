<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class DelegationController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('delegations')
            ->select(
                'delegations.*',
                'delegations.delegation_code',
            )
            ->where('delegations.active', 1);

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('delegations', 'province', 'update', $id);
                        $btn_delete = btn_delete('delegations', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                     
                    })
                ->rawColumns(['action'])
               	->make(true);

        }
        return view('options_01.delegation.index');
    }
    public function save(Request $req){

        $data['delegation_name_kh'] = $req->delegation_name_kh;
        $data['delegation_name_en'] = $req->delegation_name_en;
        $data['in_by'] = $req->in_by;

        $id = DB::table('delegations')->insertGetId($data);
        if($id)
        {
            $code= sprintf("%06d", $id). "AD";
            DB::table('delegations')
                ->where('id', $id)
                ->update(['delegation_code' =>$code]);  
        }
        if($id){
            return redirect()->route('delegation.index')->with('success', 'Delegation info has been saved successfully.');
        }
        return redirect()->back()->with('error', 'Somthing went wrong! Please try again.');
    }
}
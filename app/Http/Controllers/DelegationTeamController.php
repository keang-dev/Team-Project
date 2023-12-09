<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class DelegationTeamController extends Controller
{
    public function index(Request $req){
        
        if($req->ajax()){
            $data = DB::table('delegation_teams')
            ->join('staffs', 'delegation_teams.staff_id','=','staffs.id')
            ->join('delegations', 'delegation_teams.delegation_id','=','delegations.id')
            ->join('delegation_roles', 'delegation_teams.delegationrole_id','=','delegation_roles.id')

            ->select(
                'delegation_teams.*',
                'delegations.delegation_code',
                'delegation_roles.delegationrole_name_kh',
                DB::raw("CONCAT(staffs.staff_first_name_km,' ', staffs.staff_last_name_km) as full_name"),
            )
            ->where('delegation_teams.active', 1);

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('delegation_teams', 'province', 'update', $id);
                        $btn_delete = btn_delete('delegation_teams', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }
        $data['staffs']= DB::table('staffs')->where('staffs.active', 1)->get();
        $data['delegation_roles']= DB::table('delegation_roles')->where('delegation_roles.active', 1)->get();
        $data['delegations']= DB::table('delegations')->where('delegations.active', 1)->get();
        return view('options_02.delegation_team.index', $data);
    }
    
}
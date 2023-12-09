<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Delegation_team;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $r){
        $user_id = request()->header('user_id');
        $data['audits'] = DB::table('audits')->select('*')->paginate(100);
        // $data['export'] = url('/export'); 
        // $data['import'] = asset('/excels/students.xlsx');
        return response()->json(['data' => $data]);
    }
    public function edit(Request $r){
       
        $data['audit'] = DB::table('audits')->find($id);
       
        return response()->json(['data' => $data]);
    }
    public function delegation_team(Request $r){
        
        if($r->delegation_team_id == 0){
            
            $delegation_team = delegation_team::join('staffs', 'staffs.id', 'delegation_teams.staff_id')
            ->join('delegation_roles', 'delegation_teams.delegationrole_id','=','delegation_roles.id')
            ->select(
                'delegation_teams.*',
                'delegation_roles.delegationrole_name_kh',
                DB::raw("CONCAT(staffs.staff_first_name_km,' ', staffs.staff_last_name_km) as full_name"),
                )
            // ->where('audit_id', $audit_id)
            ->orderBy('delegation_roles.id', 'asc')
            ->paginate(10);
        } else {
            $delegation_team= delegation_team::find($r->delegation_team_id);
        }
        $data['delegation_team'] = $delegation_team;
        return response()->json(['data' => $data]);
    }
    // public function index(Request $r){
    //     $data['students'] = DB::table('students')->select('*')->paginate(100);
    //     // $data['export'] = url('/export'); 
    //     // $data['import'] = asset('/excels/students.xlsx');
    //     return response()->json(['data' => $data]);
    // }
}
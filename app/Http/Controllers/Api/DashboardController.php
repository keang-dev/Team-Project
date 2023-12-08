<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Delegation_team;

class DashboardController extends Controller
{
    public function index(Request $r){
        $data['audits'] = DB::table('audits')->select('*')->paginate(100);
        // $data['export'] = url('/export'); 
        // $data['import'] = asset('/excels/students.xlsx');
        return response()->json(['data' => $data]);
    }
    public function edit(Request $r){
        $id= $r->id;
        $data['audit'] = DB::table('audits')->find($r->id);
        if($r->delegation_team_id == 0){
            $delegation_team = delegation_team::query()
            ->select('*')
            // ->where('audit_id', $r->id)
            ->paginate(10);
        } else {
            $delegation_team= delegation_team::find($r->delegation_team_id);
        }
        $data['delegation_team'] = $delegation_team;
        return response()->json(['data' => $data]);
    }
    public function delegation_team(Request $r){
        
      
        return response()->json(['data' => $data]);
    }
    // public function index(Request $r){
    //     $data['students'] = DB::table('students')->select('*')->paginate(100);
    //     // $data['export'] = url('/export'); 
    //     // $data['import'] = asset('/excels/students.xlsx');
    //     return response()->json(['data' => $data]);
    // }
}
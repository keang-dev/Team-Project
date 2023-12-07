<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Carbon\Carbon;
use App\Models\Audits;
use App\Models\Delegations;

class HomeController extends Controller
{

 
    public function index(Request $req)
    {
        // $age1_17 = [$this->reverse_birthday(60), $this->reverse_birthday(90)];
        $dateS=Carbon::now()->subDays(60)->format('Y-m-d');
        // $dateL=Carbon::now()->subDays(1)->format('Y-m-d');
        $data['audits'] = DB::table('audits')
        ->where('audit_active', 1)
        ->whereDate('created_at', '<=', $this->reverse_birthday(0))
        ->whereDate('created_at', '>=', $this->reverse_birthday(1))
        ->select(
            'audits.*',
            'audits.id',
        )
        ->get();
       
        return view('home',$data);
    }
    public function edit($id){
        $audits = Audits::find($id);
        $data['audits'] = $audits;
        // edit work experience 
        $data['delegations'] = DB::table('delegations')
            ->where('active', 1)
            ->where('audit_id', $id)
            ->get();
        $data['delegation_teams'] = DB::table('delegation_teams')
            ->join('staffs', 'delegation_teams.staff_id','=','staffs.id')
            ->join('delegations', 'delegation_teams.delegation_id','=','delegations.id')
            ->join('delegation_roles', 'delegation_teams.delegationrole_id','=','delegation_roles.id')
            ->select(
                'delegation_teams.*',
                'delegations.delegation_code',
                'delegation_roles.delegationrole_name_kh',
                DB::raw("CONCAT(staffs.staff_first_name_km,' ', staffs.staff_last_name_km) as full_name"),
            )
            ->where('delegation_teams.active', 1)
            ->where('delegation_teams.audit_id', $id)
            ->get();
            $data['one_delegation'] = DB::table('delegations')->where('active', 1)->get()->where('audit_id', $id)->count();
            $data['one_delegation_teams'] = DB::table('delegation_teams')->where('active', 1)->get()->where('audit_id', $id)->count();     
            $data['staffs']= DB::table('staffs')->where('staffs.active', 1)->get();
            $data['delegation_roles']= DB::table('delegation_roles')->where('delegation_roles.active', 1)->get();
        return view('UI.Table.auditee.index', $data);
    }
    // public function audit_delegation(Request $req){
    //     if($req->ajax()){
    //         $data = DB::table('delegations')
    //         ->where('active', 1)
    //         ->select(
    //             'delegations.*', 
    //         );
    //         // ->where('audit_id', $req->audit_id);
    //         return Datatables::of($data)
    //                 ->addIndexColumn()
    //                 ->addColumn('action', function($row){
                       
    //                 })
    //             ->rawColumns(['action'])
    //            	->make(true);

    //     }
    // }
    public function delegation_save(Request $req){
        $data['audit_id'] = $req->audit_id;
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
            return redirect()->back()->with('success', 'Delegation info has been saved successfully.');
        }
        return redirect()->back()->with('error', 'Somthing went wrong! Please try again.');
    }
    public function audit_delegation_team(Request $req){
        if($req->ajax()){
            $data = DB::table('delegation_teams')
            ->join('staffs', 'delegation_teams.staff_id','=','staffs.id')
            ->join('delegation_roles', 'delegation_teams.delegationrole_id','=','delegation_roles.id')
            ->where('active', 1)
            ->select(
                'delegation_teams.*', 
                'delegation_roles.delegationrole_name_kh',
                DB::raw("CONCAT(staffs.staff_first_name_km,' ', staffs.staff_last_name_km) as full_name"),
            )
            ->where('audit_id', $req->id);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                       
                    })
                ->rawColumns(['action'])
               	->make(true);

        }
        $data['staffs']= DB::table('staffs')->where('staffs.active', 1)->get();
        $data['delegation_roles']= DB::table('delegation_roles')->where('delegation_roles.active', 1)->get();
    }
    public function delegation_team_save(Request $req){
        $data['audit_id'] = $req->audit_id;
        $data['staff_id'] = $req->staff_id;
        $data['ddelegationrole_id'] = $req->delegationrole_id;
        $data['in_by'] = $req->in_by;

        $id = DB::table('delegation_teams')->insertGetId($data);
       
        if($id){
            return redirect()->back()->with('success', 'Delegation info has been saved successfully.');
        }
        return redirect()->back()->with('error', 'Somthing went wrong! Please try again.');
    }


    
// rek
    public function reverse_birthday( $years ){
        return date('Y-m-d', strtotime($years . 'years ago'));
    }
  
} 
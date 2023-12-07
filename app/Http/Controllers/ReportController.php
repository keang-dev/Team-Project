<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function listEmployee(Request $req){
        
        $employees = DB::table('employees')
            ->join('provinces', 'provinces.id', 'employees.province_id')
            ->join('districts', 'districts.id', 'employees.district_id')
            ->join('communes', 'communes.id', 'employees.commune_id')
            ->select(
                'employees.*',
                'provinces.name as province_name',
                'districts.name as district_name',
                'communes.name as commune_name'
            )
            ->where('employees.active', 1);
        if(isset($req->province_id)){
            $province_id = $req->province_id;
            $employees->where(function ($query) use ($province_id) {
                $query->where('provinces.id', $province_id);
            });
        }
        if(isset($req->district_id)){
            $district_id = $req->district_id;
            $employees->where(function ($query) use ($district_id) {
                $query->where('districts.id', $district_id);
            });
        }

        $per_page = 10;
        if(isset($req->per_page)){
            $per_page = $req->per_page;
        }
        if( $per_page == 'all'){
            $data['employees'] = $employees->paginate(10000);
        }else{
            $data['employees'] = $employees->paginate($per_page);
        }


        $data['provinces'] = DB::table('provinces')->where('active', 1)->get();
        $data['row_perpage'] = (object) [
            ['name' => '5 Rows', 'value' => 5],
            ['name' => '10 Rows', 'value' => 10],
            ['name' => '50 Rows', 'value' => 50],
            ['name' => '100 Rows', 'value' => 100],
            ['name' => '500 Rows', 'value' => 500],
            ['name' => '1000 Rows', 'value' => 1000],
            ['name' => '5000 Rows', 'value' => 4000],
            ['name' => 'All', 'value' => 'all'],
        ];


        return view('reports.list_employee', $data);
    }
}

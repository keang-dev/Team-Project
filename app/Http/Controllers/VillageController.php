<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use DB;

class VillageController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('villages')
            ->join('communes', 'communes.id', 'villages.commune_id')
            ->join('districts', 'districts.id', 'communes.district_id')
            ->join('provinces', 'provinces.id', 'districts.province_id')
            ->select(
                'villages.id',
                'villages.name as village_name',
                'communes.name as commune_name',
                'districts.name as district_name',
                'provinces.name as province_name'
            )
            ->where('villages.active', 1);

            // filter 
            if($req->province_id){
                $province_id = $req->province_id;
                $data->where(function ($query) use ($province_id) {
                    $query->where('provinces.id', $province_id);
                });
            }
            if($req->district_id){
                $district_id = $req->district_id;
                $data->where(function ($query) use ($district_id) {
                    $query->where('districts.id', $district_id);
                });
            }
            if($req->commune_id){
                $commune_id = $req->commune_id;
                $data->where(function ($query) use ($commune_id) {
                    $query->where('communes.id', $commune_id);
                });
            }

            if($req->village_name){
                $village_name = $req->village_name;
                $data->where(function ($query) use ($village_name) {
                    $query->where('villages.name', 'like', "%$village_name%")
                    ->orWhere('communes.name', 'like', "%$village_name%")
                    ->orWhere('districts.name', 'like', "%$village_name%")
                    ->orWhere('provinces.name', 'like', "%$village_name%");
                });
            }

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $del_url = route('village.delete', $row->id);
                        $btn_edit = '<a class="btn btn-info btn-sm" onclick="edit('.$row->id.', this)"><i class="fa fa-edit"></i></a>' ;
                        $btn_delete = '<a class="btn btn-danger btn-sm" tbl="villages" key="id" onclick="deleteRecord('.$row->id.', this)"><i class="fa fa-trash"></i></a>' ;

                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);

        }

        $data['provinces'] = DB::table('provinces')->where('active', 1)->get();
        return view('villages.index', $data);
    }

    public function save(Request $req){
        $data['name'] = $req->village;
        $data['commune_id'] = $req->commune_id;
        
        $id = DB::table('villages')->insertGetId($data);
        if($id){
            return response()->json(
                [
                    'status' => 200,
                    'data' => $id,
                    'sms' => 'Insert successfully.',
                ]
            );
        }
        return response()->json(
            [
                'status' => 500,
                'data' => NULL,
                'sms' => 'Something went wrong!.',
            ]
        );
    }

    public function edit($id){
        try{
            $data = DB::table('villages')
            ->join('communes', 'communes.id', 'villages.commune_id')
            ->join('districts', 'districts.id', 'communes.district_id')
            ->join('provinces', 'provinces.id', 'districts.province_id')
            ->where('villages.id', $id)
            ->select(
                'provinces.id as province_id',
                'districts.id as district_id',
                'communes.id as commune_id',
                'villages.id as village_id',
                'villages.name',
            )
            ->first();

            return response()->json(
                [
                    'status' => 200,
                    'data' => $data,
                    'sms' => 'successfully.',
                ]
            );
        }catch(Exception $e){
            return 0;
            // dd($e);
        }
        
    }

    public function update(Request $req){
        try{
            $data['name'] = $req->village;
            $data['commune_id'] = $req->commune_id;
            
            DB::table('villages')->where('id', $req->id)->update($data);
            return response()->json(
                [
                    'status' => 200,
                    'data' => $req->id,
                    'sms' => 'Insert successfully.',
                ]
            );
        }catch(Exception $e){
            dd($e);
        }
       
       
        return response()->json(
            [
                'status' => 500,
                'data' => NULL,
                'sms' => 'Something went wrong!.',
            ]
        );
    }

    public function delete($id){
        try{
            DB::table('villages')->where('id', $id)->update(['active' => 0]);
            return 1;
        }catch(Exception $e){
            return 0;
            // dd($e);
        }
        
    }

    public function getVillageById(Request $request){
        $villages = DB::table('villages')
            ->where('active', 1)
            ->where('commune_id', $request->id)
            ->get();
        return $villages;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class DistrictController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('districts')
            ->join('provinces', 'provinces.id', 'districts.province_id')
            ->select(
                'districts.id',
                'districts.name as district_name',
                'provinces.name as province_name'
            )
            ->where('districts.active', 1);

            // filter 
            if($req->province_id){
                $province_id = $req->province_id;
                $data->where(function ($query) use ($province_id) {
                    $query->where('provinces.id', $province_id);
                });
            }
            
            if($req->name){
                $name = $req->name;
                $data->where(function ($query) use ($name) {
                    $query->where('districts.name', 'like', "%$name%")
                    ->orWhere('provinces.name', 'like', "%$name%");
                });
            }

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $del_url = route('village.delete', $row->id);
                        $btn_edit = '<a class="btn btn-info btn-sm" onclick="edit('.$row->id.', this)"><i class="fa fa-edit"></i></a>' ;
                        $btn_delete = '<a class="btn btn-danger btn-sm" tbl="districts" key="id" onclick="deleteRecord('.$row->id.', this)"><i class="fa fa-trash"></i></a>' ;
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }

        $data['provinces'] = DB::table('provinces')->where('active', 1)->get();
        return view('districts.index', $data);
    }

    public function edit($id){
        try{
            $data = DB::table('districts')
            ->join('provinces', 'provinces.id', 'districts.province_id')
            ->where('districts.id', $id)
            ->select(
                'districts.*',
                'provinces.id as province_id'
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
    
    public function getDistrictById(Request $request){
        $districts = DB::table('districts')
            ->where('active', 1)
            ->where('province_id', $request->id)
            ->get();
        return $districts;
    }
}

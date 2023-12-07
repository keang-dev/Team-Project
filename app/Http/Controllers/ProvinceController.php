<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class ProvinceController extends Controller
{
    public function index(Request $req){
        // check permission
        if(!check_permission('province', 'view')){
            return redirect()->route('no-permission');
        }
        
        if($req->ajax()){
            $data = DB::table('provinces')
            ->where('provinces.active', 1);

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
                    $query->where('provinces.name', 'like', "%$name%");
                });
            }

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;

                        $btn_edit = btn_edit('provinces', 'province', 'update', $id);
                        $btn_delete = btn_delete('provinces', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        $photo_video = "<a hreft=''>Photo and Videos</a>";
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);

        }

        $data['provinces'] = DB::table('provinces')->where('active', 1)->get();
        return view('provinces.index', $data);
    }
    
    public function getDistrictById(Request $request){
        $districts = DB::table('districts')
            ->where('active', 1)
            ->where('province_id', $request->id)
            ->get();
        return $districts;
    }
}

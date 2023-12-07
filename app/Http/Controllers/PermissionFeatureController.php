<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class PermissionFeatureController extends Controller
{
    public function index(Request $req, $id){
        if($req->ajax()){
            $data = DB::table('permission_features')
            ->where('permission_id', base64_decode($id))
            ->where('permission_features.active', 1);

            // filter 
            if($req->name){
                $name = $req->name;
                $data->where(function ($query) use ($name) {
                    $query->where('permission_features.name', 'like', "%$name%");
                });
            }

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $tbl = 'permission_features';
                        $id = $row->id;
                        $key = 'id';
                        
                        $btn_edit = '<a class="btn btn-info btn-sm" onclick="edit('.$row->id.',  this)"><i class="fa fa-edit"></i></a>' ;
                        $btn_delete = '<a class="btn btn-danger btn-sm" tbl="roles" key="id" onclick="deleteRecord('.$row->id.', this)"><i class="fa fa-trash"></i></a>' ;

                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);

        }

        $data['permission'] = DB::table('permissions')->find(base64_decode($id));

        return view('permission_features.index', $data);
    }
}

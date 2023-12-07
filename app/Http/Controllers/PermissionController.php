<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class PermissionController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('permissions')
            ->where('permissions.active', 1);

            // filter 
            if($req->name){
                $name = $req->name;
                $data->where(function ($query) use ($name) {
                    $query->where('permissions.name', 'like', "%$name%");
                });
            }

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $tbl = 'permissions';
                        $id = $row->id;
                        $key = 'id';
                        $url_feature = route('permission_feature.index', base64_encode($id));
                        $btn_edit = '<a class="btn btn-info btn-sm" onclick="edit('.$row->id.',  this)"><i class="fa fa-edit"></i></a>' ;
                        $btn_delete = '<a class="btn btn-danger btn-sm" tbl="roles" key="id" onclick="deleteRecord('.$row->id.', this)"><i class="fa fa-trash"></i></a>' ;
                        $btn_feature = '<a href="'.$url_feature.'" class="btn btn-warning btn-sm"><i class="fa fa-list"></i></a>' ;
                        $btns = $btn_feature .' '. $btn_edit .' '. $btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);

        }
        return view('permissions.index');
    }
}

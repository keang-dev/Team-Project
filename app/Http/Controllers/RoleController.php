<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class RoleController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('roles')
            ->where('roles.active', 1);

            // filter 
            if($req->name){
                $name = $req->name;
                $data->where(function ($query) use ($name) {
                    $query->where('roles.name', 'like', "%$name%");
                });
            }

            return Datatables::of($data)
                    ->addIndexColumn()
                   
                    ->addColumn('action', function($row){
                        $tbl = 'roles';
                        $id = $row->id;
                        $key = 'id';
                        
                        $btn_edit = '<a class="btn btn-info btn-sm" onclick="edit('.$row->id.',  this)"><i class="fa fa-edit"></i></a>' ;
                        $btn_delete = '<a class="btn btn-danger btn-sm" tbl="roles" key="id" onclick="deleteRecord('.$row->id.', this)"><i class="fa fa-trash"></i></a>' ;
                        $permission_url = route('role_permission.index', base64_encode($id));
                        $btn_set_permission = '<a href="'.$permission_url.'" class="btn btn-warning btn-sm"><i class="fa fa-key"></i></a>' ;
                        $btns = $btn_set_permission .' '. $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);

        }
        return view('roles.index');
    }
}
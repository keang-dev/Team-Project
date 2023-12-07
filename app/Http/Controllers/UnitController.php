<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class UnitController extends Controller
{
    public function index(Request $req){
        
        if($req->ajax()){
            $data = DB::table('units')
            ->join('entitys', 'units.entity_id','=','entitys.id')
            ->select(
                'units.*',
                'entitys.entity_name_km',
            )
            ->where('units.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('units', 'province', 'update', $id);
                        $btn_delete = btn_delete('units', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }
        $data['entitys']= DB::table('entitys')->where('entitys.active', 1)->get();
        return view('options_01.unit.index', $data);
    }
} 
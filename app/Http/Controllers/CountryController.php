<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class CountryController extends Controller
{
    public function index(Request $req){
      
        if($req->ajax()){
            $data = DB::table('countrys')
            ->select(
                'countrys.id',
                'countrys.country_name_km',
                'countrys.country_name_en',
            )
            ->where('countrys.active', 1);

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){           
                        $id = $row->id;
                        $btn_edit = btn_edit('countrys', 'country', 'update', $id);
                        $btn_delete = btn_delete('countrys', 'country', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);

        }
        return view('country.index');
    }
    
}
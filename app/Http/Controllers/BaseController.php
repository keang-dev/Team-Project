<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BaseController extends Controller
{
    // save
    public function save(Request $req){
        if(isset($req->file_path)){
            $file_path = $req->file_path;
        }else{
            $file_path = 'image/';
        }
        $data = $req->except('_token', 'per', 'entity', 'unique_col', 'file_path');

        $table_name = $req->entity;
        // check unique value for base action
        $unique_col = $req->unique_col;
        if($unique_col){
           $count = DB::table($table_name)->where($unique_col, $req[$unique_col])->where('active', 1)->count();
           if($count){
                return response()->json(
                    [
                        'status' => 400,
                        'data' => $unique_col,
                        'sms' => 'Cannot insert duplicated value!!',
                    ]
                );
           }
        }

        if($req->hasFile('photo')){ // check have or not
            $file = $req->file('photo'); // get file object
            $name = strtotime('now').rand(0, 9999).'.'.$file->getClientOriginalExtension(); // get file extention
            $destination = public_path($file_path);
            $file->move($destination, $name); // upload
            $data['photo'] = $name;
        }

        $id = DB::table($table_name)->insertGetId($data);
        return response()->json(
            [
                'status' => 200,
                'data' => $id,
                'sms' => 'Insert successfully.',
            ]
        );
    }

    // update
    public function update(Request $req){
        try{
            $data = $req->except('_token', 'per', 'entity');
            $table_name = $req->entity;
            DB::table($table_name)->where('id', $req->id)->update($data);
            return response()->json(
                [
                    'status' => 200,
                    'data' => $data,
                    'sms' => 'Updated successfully.',
                ]
            );
        }catch(Exception $e){
            // return $e;
        }
       
    }

    // get edit info 
    public function edit(Request $req){
        $id = $req->id;
        $table_name = $req->entity;
        $data = DB::table($table_name)->find($id);
        return response()->json(
            [
                'status' => 200,
                'data' => $data,
                'sms' => 'Got data successfully.',
            ]
        ); 
    }

    // delete 
    public function delete(Request $req){
        $table_name = $req->entity;
        $id = $req->id;
        $column_id = $req->key ? $req->key : 'id';
        DB::table($table_name)->where($column_id, $id)->update(['active' => 0]);
        return response()->json(
            [
                'status' => 200,
                'data' => $id,
                'sms' => 'Insert successfully.',
            ]
        );
    }
}

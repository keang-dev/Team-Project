<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Excel;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;

class StudentController extends Controller
{
    public function index(Request $r){
        $user_id = request()->header('user_id');
        $data['students'] = DB::table('students')->select('*')->paginate(100);
        $data['export'] = url('/export'); 
        $data['import'] = asset('/excels/students.xlsx');
        return response()->json(['data' => $data]);
    }
    public function store(Request $r){
        DB::table('students')->insert([
            'name' => $r->name,
            'age' => $r->age
        ]);

        return $this->shareData(['status' => 'success', 'sms' => 'insert successfully']);
    }
    public function delete(Request $r){
        DB::table('students')->where('id',$r->id)->delete();
        return $this->shareData(['status' => 'success', 'sms' => 'delete successfully']);
    }
    public function edit(Request $r){
        $data['student'] = DB::table('students')->find($r->id);

        return response()->json(['data' => $data]);
    }
    public function update(Request $r){
        DB::table("students")->where('id',$r->id)->update([
            'name' => $r->name,
            'age' => $r->age
        ]);
        return $this->shareData(['status' => 'success', 'sms' => 'update successfully']);

    }
    public function export(Request $r){
        return Excel::download(new StudentsExport, 'student.xlsx');
    }
    public function import(Request $r){
        Excel::import(new StudentsImport, $r->file('excel'));

        return $this->shareData(['status' => 'success', 'sms' => 'Import successfully']);

    }
}
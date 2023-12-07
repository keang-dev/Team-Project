<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Employee;

class EmployeeController extends Controller
{

    public function index(Request $req){
        // check permission
         if(!check_permission('employee', 'view')){
            return redirect()->route('no-permission');
        }

        if($req->ajax()){
            $data = DB::table('employees')
            ->join('provinces', 'provinces.id', 'employees.province_id')
            ->join('districts', 'districts.id', 'employees.district_id')
            ->join('communes', 'communes.id', 'employees.commune_id')
            ->join('villages', 'villages.id', 'employees.village_id')
            ->select(
                'employees.*',
                'provinces.name as province_name',
                'districts.name as district_name',
                'communes.name as commune_name',
                'villages.name as village_name',
                DB::raw('IF(employees.gender = 1, "Male", "Female") as gender')
            )
            ->where('employees.active', 1);

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

            if($req->name){
                $name = $req->name;
                $data->where(function ($query) use ($name) {
                    $query->where('communes.name', 'like', "%$name%")
                    ->orWhere('districts.name', 'like', "%$name%")
                    ->orWhere('provinces.name', 'like', "%$name%");
                });
            }

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $edit_route = route('employee.edit', $row->id);
                        $btn_edit = '<a href="'.$edit_route.'" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>' ;
                        $btn_delete = btn_delete('employees', 'employee', 'delete', $row->id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                    ->addColumn('data_status', function($row){

                        $status = '';
                        $work = DB::table('employee_work_experiences')->where('active', 1)->where('employee_id', $row->id)->count();
                        $family = DB::table('employee_families')->where('active', 1)->where('employee_id', $row->id)->count();
                        
                        if($work == 0){
                            $status .= '<span class="badge badge-warning">Work inprogress</span> <br>';
                        }
                        if($family == 0){
                            $status .= '<span class="badge badge-warning">Family inprogress</span> ';
                        }

                        // if all is done 
                        if($work > 0 && $family > 0){
                            $status = '<span class="badge badge-success">Completed</span>';
                        }
                       
                        return $status;
                    })
                ->rawColumns(['action', 'data_status'])
               	->make(true);

        }

        $data['provinces'] = DB::table('provinces')->where('active', 1)->get();
        return view('employees.index', $data);
    }

    public function create(){
        // check permission
        if(!check_permission('employee', 'create')){
            return redirect()->route('no-permission');
        }
        $data['provinces'] = DB::table('provinces')->where('active', 1)->get();
        return view('employees.create', $data);
    }

    public function save(Request $req){
        $emp = new Employee;
        $emp->first_name = $req->first_name;
        $emp->last_name = $req->last_name;
        $emp->gender = $req->gender;
        $emp->dob = $req->dob;
        $emp->pob = $req->pob;
        $emp->province_id = $req->province_id;
        $emp->district_id = $req->district_id;
        $emp->commune_id = $req->commune_id;
        $emp->village_id = $req->village_id;
        $emp->marry_status = $req->marry_status;
        $emp->created_by = auth()->user()->id;
        if($req->hasFile('photo')){ // check have or not
            $file = $req->file('photo'); // get file object
            $name = strtotime('now').rand(0, 9999).'.'.$file->getClientOriginalExtension(); // get file extention
            $destinationPath = 'images/'.$name;
            saveFile($file, $destinationPath);
            $emp->photo = $destinationPath; // set file name in database
        }
        if($emp->save()){
            return redirect()->route('employee.edit', $emp->id)->with('success', 'Employee personal info has been saved successfully.');
        }
        return redirect()->back()->with('error', 'Somthing went wrong! Please try again.');

    }

    public function update(Request $req){
        $emp = Employee::find($req->id);
        $emp->first_name = $req->first_name;
        $emp->last_name = $req->last_name;
        $emp->gender = $req->gender;
        $emp->dob = $req->dob;
        $emp->pob = $req->pob;
        $emp->province_id = $req->province_id;
        $emp->district_id = $req->district_id;
        $emp->commune_id = $req->commune_id;
        $emp->village_id = $req->village_id;
        $emp->marry_status = $req->marry_status;
        $emp->created_by = auth()->user()->id;
        if($req->hasFile('photo')){ // check have or not
            $file = $req->file('photo'); // get file object
            $name = strtotime('now').rand(0, 9999).'.'.$file->getClientOriginalExtension(); // get file extention
            $destinationPath = 'images/'.$name;
            saveFile($file, $destinationPath);
            // $file->move($destination, $name); // upload
            $emp->photo = $destinationPath; // set file name in database
        }
        if($emp->save()){
            return redirect()->route('employee.edit', $emp->id)->with('success', 'Employee personal info has been saved successfully.');
        }
        return redirect()->back()->with('error', 'Somthing went wrong! Please try again.');

    }

    public function edit($id){
        $employee = Employee::find($id);
        $data['provinces'] = DB::table('provinces')->where('active', 1)->get();
        $data['districts'] = DB::table('districts')->where('active', 1)->where('province_id', $employee->province_id)->get();
        $data['communes'] = DB::table('communes')->where('active', 1)->where('district_id', $employee->district_id)->get();
        $data['villages'] = DB::table('villages')->where('active', 1)->where('commune_id', $employee->commune_id)->get();
        $data['relationships'] = DB::table('relationships')->where('active', 1)->get();
        $data['work_status'] = DB::table('employee_work_experiences')->where('active', 1)->where('employee_id', $id)->count();
        $data['employee'] = $employee;

        // edit work experience 
        $data['work_experiences'] = DB::table('employee_work_experiences')
            // ->where('active', 1)
            ->where('employee_id', $id)
            ->orderBy('start_date', 'desc')
            ->get();
 
        return view('employees.edit', $data);
    }

    public function workExperience(Request $req){
        if($req->ajax()){
            $data = DB::table('employee_work_experiences')
            ->where('active', 1)
            ->where('employee_id', $req->employee_id);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn_edit = btn_edit('employee_work_experiences', 'employee', 'update', $row->id);
                        $btn_delete = btn_delete('employee_work_experiences', 'employee', 'delete', $row->id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);

        }
    }

    public function familyInfo(Request $req){
        if($req->ajax()){
            $data = DB::table('employee_families')
                ->join('relationships', 'relationships.id', 'employee_families.relationship_id')
                ->where('employee_families.active', 1)
                ->where('employee_id', $req->employee_id)
                ->select(
                    'employee_families.*',
                    'relationships.name as relationship',
                    DB::raw('IF(employee_families.gender = 1, "Male", "Female") as sex')
                );
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $js_funtion_edit = "getEditFamily($row->id, this)";
                        $btn_edit = btn_edit('employee_families', 'employee', 'update', $row->id, $js_funtion_edit);
                        $btn_delete = btn_delete('employee_families', 'employee', 'delete', $row->id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);

        }
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use DB;
use App\Models\User;
use Carbon\Carbon;
use Auth;
class UserController extends Controller
{
   
    public function index(Request $req){
        

       if($req->ajax()){
        $data = DB::table('users')
            ->join('roles', 'roles.id', 'users.role_id')
            ->join('units', 'units.id', 'users.unit_id')
            ->join('positions', 'positions.id', 'users.position_id')


            // ->where('users.created_by', auth()->user()->id)
            ->where('users.active', 1)
            ->select(
                'users.*',
                'roles.name as role_name',
                'units.unit_name_km as unit_name',
             
                'positions.position_name_km as position_name',
                

                DB::raw('IF(users.sex = 1, "ប្រុស", "ស្រី") as gender'),
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) as full_name"),
            );
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('custom_name', function($row){
                $user = User::find($row->id);
                return $user->first_name.' '.$user->last_name;

            })
            ->addColumn('action', function($row){
                // $reset_url = route('user.reset_password', $row->id);
                
                // $btn_reset_password = btn_reset_password('users', 'user', 'reset_password', $row->id);
                $btn_edit = btn_edit('users', 'user', 'update', $row->id);
                $btn_delete = btn_delete('users', 'user', 'delete', $row->id);
                $btns = $btn_edit.' '.$btn_delete;
                return $btns;
            })
            ->addColumn('photo', function($row){
                $img_url = getImage($row->photo);
                $photo = "<img src='$img_url' class='avatar' width='50px'>";
                return $photo;
            })
            ->rawColumns(['action', 'custom_name', 'photo'])
            ->make(true);
       }

       $data['roles'] = DB::table('roles')->where('active', 1)->get();
       $data['units'] = DB::table('units')->where('active', 1)->get();
       $data['positions'] = DB::table('positions')->where('active', 1)->get();


       return view('users.index', $data);
    }

    public function save(Request $req){
        if(User::where('email', $req->email)->count()){
            return redirect()->back()->with('error', 'Email aready exist!');
        }
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->sex = $req->sex;
        $user->position_id = $req->position_id;
        $user->unit_id = $req->unit_id;
        $user->phone_number = $req->phone_number;
        $user->role_id = $req->role_id;
        $user->created_by = auth()->user()->id;
        $user->password = Hash::make($req->password);

        if($req->hasFile('photo')){ // check have or not
            $file = $req->file('photo'); // get file object
            $name = strtotime('now').rand(0, 9999).'.'.$file->getClientOriginalExtension(); // get file extention
            $destination = public_path('/images');
            $file->move($destination, $name); // upload
            $user->photo = $name; // set file name in database
        }
  

        if($user->save()){
            return redirect()->back()->with('success', 'User created successfully.');
        }
        return redirect()->back()->with('error', 'Somthing went wrong!');
    }

    public function update(Request $req){
        // if(User::where('email', $req->email)->count()){
        //     return redirect()->back()->with('error', 'Email aready exist!');
        // }
        $user =  User::find($req->id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->sex = $req->sex;
        $user->position_id = $req->position_id;
        $user->unit_id = $req->unit_id;
        $user->phone_number = $req->phone_number;
        $user->role_id = $req->role_id;
        $user->created_by = auth()->user()->id;
        $user->password = Hash::make($req->password);
       
        if($req->password){
            $user->password = Hash::make($req->password);
        }

        if($req->hasFile('photo')){ // check have or not
            $file = $req->file('photo'); // get file object
            $name = strtotime('now').rand(0, 9999).'.'.$file->getClientOriginalExtension(); // get file extention
            $destination = public_path('/images');
            $file->move($destination, $name); // upload
            $user->photo = $name; // set file name in database
        }
        if($user->save()){
            return redirect()->back()->with('success', 'Update បានជោគជ័យ.');
        }
        return redirect()->back()->with('error', 'សូមត្រួតពិនិត្យម្តងទៀត!');
    }
 
    public function save_password(Request $r)
    {
        
        // $r->validate([
        //     'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|confirmed',
           
        // ]);
        $r->validate(
            [
                'password' => 'required|min:8|regex:/^.(?=.*[a-zA-Z])(?=.*[0-9]).*$/|confirmed|unique:users',
            ],
            [
                'password.min' => 'លេខសម្ងាត់យ៉ាងតិច (៨) ខ្ទង់ឡើងទៅ!',
                'password.confirmed' => 'លេខសម្ងាត់ confirmed មិនត្រឹមត្រូវ!',
                'password.regex' => 'លេខសម្ងាត់ត្រូវតែមាន (លេខ, សញ្ញា, អក្សរតូច អក្សរធំនៅជាមួយគ្នា) ឧ​៖(NAA@ff1ce)!'
            ]
        );

        
        $data = array(
            'id'=>($r->id),
            'password' => bcrypt($r->password)
        );
        $i = DB::table('users')
            ->where('id', $r->id)
            ->update($data);

        if($i){
            return redirect()->back()->with('success', 'លេខសម្ងាត់ត្រូវបានផ្លាស់ប្តូរ ដោយជោគជ័យ!!.');
        }
        return redirect()->back()->with('error', 'បរាជ័យក្នុងការផ្លាស់ប្តូរលេខសម្ងាត់!');
    }
    public function profile()
    {
        $data['user'] = DB::table('users')
            ->join('roles', 'users.role_id', 'roles.id')
            ->where('users.id', Auth::user()->id)
            ->select('users.*', 'roles.name as rname')
            ->first();
        return view('users.profile', $data);
    }

 
    public function logout(){
        if(Auth::logout()){
            return redirect()->route('login');
        }
        return redirect()->back();
    }
    
}
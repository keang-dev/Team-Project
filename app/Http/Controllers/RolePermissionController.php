<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\RolePermission;

class RolePermissionController extends Controller
{
    public function index(Request $req, $role_id){
        $id = base64_decode($role_id);
        $role = DB::table('roles')->find($id);
        $role_permissions = DB::table('role_permissions')
        ->join('roles', 'roles.id', 'role_permissions.role_id')
        ->join('permissions', 'permissions.id', 'role_permissions.permission_id')
        ->select(
            'role_permissions.*',
            'roles.name as role_name',
            'permissions.name as permission_name'
        )
        ->where('role_id', $id)
        ->where('roles.active', 1)
        ->where('permissions.active', 1)
        ->get();

        $data['role'] = $role;
        $data['role_permissions'] = $role_permissions;
        return view('role_permissions.index', $data);
    }


    public function reGenerateRole(){
        $roles = DB::table('roles')->where('active', 1)->get();
        $permissions = DB::table('permissions')->where('active', 1)->get();
        foreach($roles as $role){
            foreach($permissions as $per){
                $role_permission_no = DB::table('role_permissions')
                ->where('role_id', $role->id)
                ->where('permission_id', $per->id)
                ->count();
                if($role_permission_no == 0){
                    $role_permission = new RolePermission();
                    $role_permission->role_id = $role->id;
                    $role_permission->permission_id = $per->id;
                    $role_permission->save();
                }
            }
        }
        return redirect()->back();
    }

    public function savePermission(Request $req){
        // dd($req->all());
        $role_permission_ids = $req->id;
        
        foreach($role_permission_ids as $id){
            $data = $req['p_'.$id];
            $per = json_encode($data);
            $role_p = RolePermission::find($id);
            $role_p->permisions = ($per=='null' || $per=='[null]')? NULL : $per;
            $role_p->save();
        }
        return response()->json([
            'status' => 200,
            'data' => $data,
            'sms' => 'Data saved successfully.',
        ]);
    }
}

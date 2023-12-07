<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\RolePermission;
use App\Models\Role;
use App\Models\PermissionFeature;
use App\Models\Permission;

class RolePermissionController extends Controller
{
    public function index(Request $r){
        $role_id = $r->role_id;
        $permissions = DB::table('permissions')
                        ->leftJoin(DB::raw("(Select * from role_permissions where role_id = $role_id) as rolePer"), 'rolePer.permission_id','permissions.id')
                       ->select('permissions.*','rolePer.permission_feature_id');
        if(DB::table('users')->find($r->header('user_id'))->role_id != 1){
            $permissions->whereNotIn('permissions.id',[4,6]);
        }
        $permissions = $permissions->get();
        foreach ($permissions as $index => $permission) {
            if($permission->permission_feature_id){
                $feature_ids = array_values((array)json_decode($permission->permission_feature_id));
                $permissions[$index]->features = [];
                foreach ($feature_ids as $j => $feature_id) {
                    $feature = DB::table('permission_features')->find($feature_id);
                    $feature->permission = 1;

                    array_push($permissions[$index]->features, $feature);
                }


                $checkNoPermission = DB::table('permission_features')->whereNotIn('id',$feature_ids)->where('permission_id',$permission->id)->select('permission_features.*', DB::raw('0 as permission'))->get();
                if(count($checkNoPermission) > 0){
                    foreach ($checkNoPermission as $key => $c) {
                        array_push($permissions[$index]->features, $c);
                    }
                }
            } else { // null
                $features = DB::table('permission_features')
                        ->where('permission_id', $permission->id)
                        ->select('permission_features.*', DB::raw('0 as permission'))
                        ->get();

                $permissions[$index]->features = $features;
            }
        }
       
        return  $this->shareData(['permissions' => $permissions]);
    }
    public function action(Request $r){
        DB::beginTransaction();
        try {

            $role_permission = RolePermission::where(['permission_id' => $r->permission_id, 'role_id' => $r->role_id])->first();

            if(!$role_permission){ // null
                $feature_ids = [];
                array_push($feature_ids, $r->permission_feature_id);

                $role_permission = new RolePermission;
                $role_permission->role_id = $r->role_id;
                $role_permission->permission_id = $r->permission_id;
                $role_permission->permission_feature_id = json_encode($feature_ids);
                $role_permission->save();

            } else {

                $feature_ids = $role_permission->permission_feature_id;

                
                $feature_ids = json_decode($feature_ids);
                
                if(in_array($r->permission_feature_id, $feature_ids)){
                    unset($feature_ids[array_search($r->permission_feature_id,$feature_ids)]);
                } else {
                    array_push($feature_ids,$r->permission_feature_id);
                }



                $feature_ids = json_encode(array_values((array)$feature_ids));
                $role_permission->permission_feature_id = $feature_ids;
                $role_permission->save();
            }
            
            DB::commit();

            return $this->shareData(['status' => 'success', 'sms' => __('Update Succesffully')]);
            
        } catch (\Throwable $th) {
            DB::rollback();
            //throw $th;
            return  $this->shareData(['status' => 'error', 'sms' => $th->getMessage()]);
        }
    }
}

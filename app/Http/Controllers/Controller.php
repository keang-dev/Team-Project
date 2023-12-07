<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sharePermission($action = 'view', $user_id = ''){
        $user_role_id = auth()->user()->role_id;

    // param permission, action
    $feature = DB::table('permission_features')
        ->join('permissions', 'permissions.id', 'permission_features.permission_id')
        ->where('permission_features.aleas', $action)
        ->where('permissions.key', $permission)
        ->select('permission_features.id')
        ->first();
    $role_permission = DB::table('role_permissions')
        ->join('permissions', 'permissions.id', 'permission_id')
        ->where('permissions.key', $permission)
        ->where('role_permissions.role_id', $user_role_id)
        ->first();
    
    if($role_permission->permisions && in_array($feature->id, json_decode($role_permission->permisions))){
        return 1;
    }
    
    return 0;
    }

    public function shareData($data, $user_id = ''){
        try {
            $data['permission'] = $this->sharePermission('view',$user_id);
            return response()->json($data);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
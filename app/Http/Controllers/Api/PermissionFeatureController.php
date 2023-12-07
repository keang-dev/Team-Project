<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermissionFeature;
use App\Models\Permission;
use DB;

class PermissionFeatureController extends Controller
{
    public function index(Request $r){
        if($r->permission_feature_id == 0){
            $permission_feature = PermissionFeature::where('permission_id',$r->permission_id)->select('*')->paginate(100);
        } else {
            $permission_feature = PermissionFeature::find($r->permission_feature_id);
        }
        $data['permission_feature'] = $permission_feature;
        $data['permission'] = Permission::find($r->permission_id);
        return response()->json(['data' => $data]);
    }
    public function store(Request $r){
        try {
            $permission_feature = new PermissionFeature;
            $permission_feature->permission_id = $r->permission_id;
            $permission_feature->name = $r->name;
            $permission_feature->key = $r->key;
            $permission_feature->note = $r->note;
            $permission_feature->save();

            return response()->json(['status' => 'success', 'sms' => 'បញ្ចូលបានសម្រេច!!!']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }

    public function update(Request $r){
        try {
            $permission_feature = PermissionFeature::find($r->permission_feature_id);
            $permission_feature->name = $r->name;
            $permission_feature->key = $r->key;
            $permission_feature->note = $r->note;

            $permission_feature->save();

            return response()->json(['status' => 'success', 'sms' => 'Update Successfully']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }
    public function delete(Request $r){
        try {
            $role = PermissionFeature::find($r->permission_feature_id)->delete();
            return response()->json(['status' => 'success', 'sms' => 'Delete Successfully']);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }
    }
}

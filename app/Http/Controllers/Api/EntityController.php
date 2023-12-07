<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Entity;
class EntityController extends Controller
{
    public function index(Request $r){
        if($r->entity_id == 0){
            $entity = entity::query()->select('*')->where('active', 1)->paginate(100);
        } else {
            $entity = entity::find($r->entity_id);
        }
        $data['entity'] = $entity;
        // return $this->shareData(['data' => $data]);
        return response()->json(['data' => $data]);
    }
    public function store(Request $r){
        try {
            $entity = new entity;
            $entity->entity_name_km = $r->entity_name_km;
            $entity->entity_name_en = $r->entity_name_en;
            $entity->save();

            return response()->json(['status' => 'success', 'sms' => 'បញ្ចូលបានសម្រេច!!!']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }

    public function update(Request $r){
        try {
            $entity = entity::find($r->entity_id);
            
            $entity->entity_name_km = $r->entity_name_km;
            $entity->entity_name_en = $r->entity_name_en;


            $entity->save();

            return response()->json(['status' => 'success', 'sms' => 'Update Successfully']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }
    public function delete(Request $r){
        try {
            $entity = entity::find($r->entity_id);
            $entity->active = 0;
            $entity->save();
            return response()->json(['status' => 'success', 'sms' => 'លុបបានជោគជ័យ']);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }
    }
   
}
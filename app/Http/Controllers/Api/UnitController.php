<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Unit;
use DataTables;
class UnitController extends Controller
{
    public function index(Request $r){
        if($r->unit_id == 0){
            $unit = unit::query()->select('*')->where('active', 1)->paginate(100);
        } else {
            $unit = unit::find($r->unit_id);
        }
        $data['unit'] = $unit;

        return response()->json(['data' => $data]);
    }
     public function delete(Request $r){
        try {
            $unit = Unit::find($r->unit_id)->delete();
            return response()->json(['status' => 'success', 'sms' => 'Delete Successfully']);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }
    }
}
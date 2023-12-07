<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AuditController extends Controller
{
    public function index(Request $req){
        
        if($req->ajax()){
            $data = DB::table('audits')
            ->join('audit_types', 'audits.audit_code','=','audit_types.id')
            ->join('auditees', 'audits.auditee_id','=','auditees.id')
            ->join('audit_stds', 'audits.auditstd_id','=','audit_stds.id')
            ->join('audit_categorys', 'audits.auditcategory_id','=','audit_categorys.id')
            ->join('audit_times', 'audits.audittime_id','=','audit_times.id')
            ->join('units', 'audits.unit_id','=','units.id')
            ->join('delegations', 'audits.delegation_id','=','delegations.id')
            ->select(
                'audits.*',
                'audit_types.audittype_name_kh', 
                'auditees.auditee_name_kh',
                'audit_stds.auditstd_name_kh',
                'audit_categorys.auditcategory_name_kh',
                'audit_times.audittime_name_kh',
                'units.unit_name_km',
                'delegations.delegation_code',
            )
            ->where('audits.audit_active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('audits', 'province', 'update', $id);
                        $btn_delete = btn_delete('audits', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                    ->addColumn('file_km', function($row){
                        $pdf_url = audit_file($row->file_km);
                        return $row->file_km == NULL ? '<a class="btn btn-danger btnActive">មិនមានឯកាសារ</a>': '<a class="btn btn-success" href="'.$pdf_url.'" target="_blank">ទាញយក</a>';
                    })
                    
                ->rawColumns(['action', 'file_km'])
               	->make(true);
        }
        $data['audit_types']= DB::table('audit_types')->where('audit_types.active', 1)->get();
        $data['auditees']= DB::table('auditees')->where('auditees.active', 1)->get();
        $data['audits']= DB::table('audits')->where('audits.audit_active', 1)->get();
        $data['audit_categorys']= DB::table('audit_categorys')->where('audit_categorys.active', 1)->get();
        
        $data['audit_stds']= DB::table('audit_stds')->where('audit_stds.active', 1)->get();
        $data['audit_times']= DB::table('audit_times')->where('audit_times.active', 1)->get();
        $data['units']= DB::table('units')->where('units.active', 1)->get();
        $data['delegations']= DB::table('delegations')->where('delegations.active', 1)->get();
        return view('options_02.audit.index', $data);
    }
    public function save(Request $req){
        // $req->validate(
        //     [
        //     'naa_card_id' => 'required|min:3|unique:staffs',
        //     'khmer_identity_card_number' => 'required|min:9|max:9|unique:staffs'
        //     ],
        //     [
        //         'naa_card_id' => 'អត្តលេខបានប្រើប្រាស់រួចហើយ សូមមេត្តាពិនិត្យឡើងវិញ!!',
        //         'khmer_identity_card_number' => 'សូមពិនិត្យលេខអត្តសញ្ញាណប័ណ្ណ អោយបានត្រឹមត្រូវ!!',
        //     ]
        // );
        $data['audit_code'] = $req->audit_code;
        $data['audit_name_kh'] = $req->audit_name_kh;
        $data['audittype_id'] = $req->audittype_id;
        $data['auditstd_id'] = $req->auditstd_id;
        $data['auditee_id'] = $req->auditee_id;
        $data['auditperiod'] = $req->auditperiod;
        $data['auditcategory_id'] = $req->auditcategory_id;
        $data['audittime_id'] = $req->audittime_id;
        $data['unit_id'] = $req->unit_id;
        $data['delegation_id'] = $req->delegation_id;
        $data['in_by'] = $req->in_by;
        if($req->hasFile('file_km')){ // check have or not
            $file = $req->file('file_km'); // get file object
            $name = strtotime('now').rand(0, 9999).'.'.$file->getClientOriginalExtension(); // get file extention
            $destination = public_path('/files/audit_file');
            $file->move($destination, $name); // upload
            $data['file_km'] = $name; // set file name in database
        }
        $id = DB::table('audits')->insertGetId($data);
        if($id)
        {
            $code= sprintf("%06d", $id). "WP";
            DB::table('audits')
                ->where('id', $id)
                ->update(['audit_code' =>$code]);  
        }
        if($id){
            return redirect()->route('audit.index')->with('success', 'audit info has been saved successfully.');
        }
        return redirect()->back()->with('error', 'Somthing went wrong! Please try again.');
    }
}
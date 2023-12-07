<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AuditDomainController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('audit_domains')
            ->join('audits', 'audit_domains.audit_id','=','audits.id')
            ->join('domains', 'audit_domains.domain_id','=','domains.id')
            ->select(
                'audit_domains.*',
                'audits.audit_code',
                'domains.domain_name_kh',
            )
            ->where('audit_domains.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('audit_domains', 'province', 'update', $id);
                        $btn_delete = btn_delete('audit_domains', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                ->rawColumns(['action'])
               	->make(true);
        }
        $data['audits']= DB::table('audits')->where('audits.audit_active', 1)->get();
        $data['domains']= DB::table('domains')->where('domains.active', 1)->get();

        return view('options_02.audit_domain.index',$data);
    }
}
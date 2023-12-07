<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AuditeeOrganizationContactController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('auditee_organization_contacts')
            ->join('auditees', 'auditee_organization_contacts.auditee_id','=','auditees.id')
            ->join('auditee_contact_types', 'auditee_organization_contacts.auditeecontacttype_id','=','auditee_contact_types.id')
            ->select(
                'auditee_organization_contacts.*',
                'auditees.auditee_name_kh',
                'auditee_contact_types.auditeecontacttype_name_kh',
            )
            ->where('auditee_organization_contacts.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('auditee_organization_contacts', 'province', 'update', $id);
                        $btn_delete = btn_delete('auditee_organization_contacts', 'province', 'delete', $id);
                        $btns = $btn_edit.' '.$btn_delete;
                        return $btns;
                    })
                    ->addColumn('is_default', function($row){
                        $is_checked = $row->is_default ? 'checked' : '';
                        $checkbox = "<input type='checkbox' value='$row->id' onchange='setDefault($row->id, this)' $is_checked>";
                        return $checkbox;
                    })
                ->rawColumns(['action', 'is_default'])
               	->make(true);
        }
        $data['auditees']= DB::table('auditees')->where('auditees.active', 1)->get();
        $data['auditee_contact_types']= DB::table('auditee_contact_types')->where('auditee_contact_types.active', 1)->get();
        return view('options_02.auditee_organization_contact..index', $data);
    }
}
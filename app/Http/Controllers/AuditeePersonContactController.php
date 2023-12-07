<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AuditeePersonContactController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('auditee_person_contacts')
            ->join('auditees', 'auditee_person_contacts.auditee_id','=','auditees.id')
            ->join('auditee_persons', 'auditee_person_contacts.auditeeperson_id','=','auditee_persons.id')
            ->join('auditee_person_types', 'auditee_person_contacts.auditeeperson_id','=','auditee_person_types.id')
            ->join('auditee_contact_types', 'auditee_person_contacts.auditeecontacttype_id','=','auditee_contact_types.id')


            ->select(
                'auditee_person_contacts.*',
                'auditees.auditee_name_kh',
                'auditee_persons.auditeeperson_name_kh',
                'auditee_person_types.auditeepersontype_name_kh',
                'auditee_contact_types.auditeecontacttype_name_kh',
            )
            ->where('auditee_person_contacts.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('auditee_person_contacts', 'province', 'update', $id);
                        $btn_delete = btn_delete('auditee_person_contacts', 'province', 'delete', $id);
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
        $data['auditee_persons']= DB::table('auditee_persons')->where('auditee_persons.active', 1)->get();
        $data['auditee_person_types']= DB::table('auditee_person_types')->where('auditee_person_types.active', 1)->get();
        $data['auditee_contact_types']= DB::table('auditee_contact_types')->where('auditee_contact_types.active', 1)->get();
        return view('options_02.auditee_person_contact.index', $data);
    }
}
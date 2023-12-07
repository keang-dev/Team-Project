<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class ClientPersonContactController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('client_person_contacts')
            ->join('clients', 'client_person_contacts.client_id','=','clients.id')
            ->join('client_persons', 'client_person_contacts.clientperson_id','=','client_persons.id')
            ->join('client_person_types', 'client_person_contacts.clientperson_id','=','client_person_types.id')
            ->join('client_contact_types', 'client_person_contacts.clientcontacttype_id','=','client_contact_types.id')


            ->select(
                'client_person_contacts.*',
                'clients.client_name_kh',
                'client_persons.clientperson_name_kh',
                'client_person_types.clientpersontype_name_kh',
                'client_contact_types.clientcontacttype_name_kh',
            )
            ->where('client_person_contacts.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('client_person_contacts', 'province', 'update', $id);
                        $btn_delete = btn_delete('client_person_contacts', 'province', 'delete', $id);
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
        $data['clients']= DB::table('clients')->where('clients.active', 1)->get();
        $data['client_persons']= DB::table('client_persons')->where('client_persons.active', 1)->get();
        $data['client_person_types']= DB::table('client_person_types')->where('client_person_types.active', 1)->get();
        $data['client_contact_types']= DB::table('client_contact_types')->where('client_contact_types.active', 1)->get();


        return view('options_02.client_person_contact.index', $data);
    }
}
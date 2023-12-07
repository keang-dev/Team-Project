<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class ClientOrganizationContactController extends Controller
{
    public function index(Request $req){
        if($req->ajax()){
            $data = DB::table('client_organization_contacts')
            ->join('clients', 'client_organization_contacts.client_id','=','clients.id')
            ->join('client_contact_types', 'client_organization_contacts.clientcontacttype_id','=','client_contact_types.id')
            ->select(
                'client_organization_contacts.*',
                'clients.client_name_kh',
                'client_contact_types.clientcontacttype_name_kh',
            )
            ->where('client_organization_contacts.active', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->id;
                        $btn_edit = btn_edit('client_organization_contacts', 'province', 'update', $id);
                        $btn_delete = btn_delete('client_organization_contacts', 'province', 'delete', $id);
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
        $data['client_contact_types']= DB::table('client_contact_types')->where('client_contact_types.active', 1)->get();


        return view('options_02.client_organization_contact..index', $data);
    }
}
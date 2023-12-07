<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Audits;
class AuditeeTableController extends Controller
{
public function index()
{
    
    return view('UI.Table.auditee.index');
}
}
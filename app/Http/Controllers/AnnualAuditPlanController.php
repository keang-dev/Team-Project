<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AnnualAuditPlanController extends Controller
{
    public function index()
    {
        return view('annual_audit_plan.index');
    }
}
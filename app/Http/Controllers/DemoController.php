<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class DemoController extends Controller
{
    public function index()
    {
        return view('AuditTeam.index');
    }
}
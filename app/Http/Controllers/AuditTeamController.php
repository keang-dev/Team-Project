<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuditTeamController extends Controller
{
    public function index()
    {
        return view('AuditTeam.index');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CondidatController extends Controller
{
    public function index()
    {
        return view('condidat.dashboardCondidat');
    }
}

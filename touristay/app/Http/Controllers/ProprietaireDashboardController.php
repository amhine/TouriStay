<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProprietaireDashboardController extends Controller
{
    public function index()
    {
        return view('proprietaire.dashboard');
    }
}


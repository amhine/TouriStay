<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TouristeDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.touriste');
    }
}

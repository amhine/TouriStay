<?php

namespace App\Http\Controllers;
use App\Models\equipement;
use Illuminate\Http\Request;

class equipementcontroller extends Controller
{
    public function index()
    {
        echo "dfgsdhsdhjfgsdfgsdgfhjdsgfjhgsdfgsdfhg,sncvnbxcds";
        
        // dd($equipement);
        return view('annonceview', compact('equipement'));
    }
    

}

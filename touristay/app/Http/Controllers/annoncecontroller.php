<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use App\Models\equipement;

class AnnonceController extends Controller
{
    public function search(Request $request)
    {
        $annoncesQuery = Annonce::query();
        
        if ($request->filled('ville')) {
            $annoncesQuery->where('ville', 'like', '%' . $request->ville . '%');
        }
        
        if ($request->filled('disponibilite')) {
            $annoncesQuery->where('disponibilite', '>=', $request->disponibilite);
        }
        
        $annonces = $annoncesQuery->paginate(9);
        
    
        $equipement = equipement::all();
        
        return view('annonceview', compact('annonces', 'equipement'));
    }
}
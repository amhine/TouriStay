<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use App\Models\equipement;
use Illuminate\Support\Facades\Auth;

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
        
        return view('touriste.annonceview', compact('annonces', 'equipement'));
    }
   


    public function index()
    {
        $userId = Auth::id(); 
        $annonces = Annonce::where('id_proprietaire', $userId)->with('equipement')->get();
    
        return view('proprietaire.annonceview', compact('annonces'));
    }
    
}
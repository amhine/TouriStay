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
        
        return view('proprietaire.annonceview', compact('annonces', 'equipement'));
    }
   


    public function index()
    {
        $userId = Auth::id(); 
        $annonces = Annonce::where('id_proprietaire', $userId)->with('equipement')->get();
    
        return view('proprietaire.annonceview', compact('annonces'));
    }

    public function afficherform(){
        return view('proprietaire.form');
    }


  
    public function store(Request $request) 
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vous devez être connecté pour ajouter une annonce.');
    }

    $request->validate([
        'titre' => 'required|string',
        'description' => 'required|string',
        'prixparnuit' => 'required|numeric',
        'nbrchambre' => 'required|numeric',
        'nbrsallesebain' => 'required|numeric',
        'adress' => 'required|string',
        'ville' => 'required|string',
        'image' => 'required|string',
        'disponibilite' => 'required|date',
    ]);

    $userId = Auth::id();  
    Annonce::create([
        'titre' => $request->titre,
        'description' => $request->description,
        'prixparnuit' => $request->prixparnuit,
        'nbrchambre' => $request->nbrchambre,
        'nbrsallesebain' => $request->nbrsallesebain,
        'adress' => $request->adress,
        'ville' => $request->ville,
        'image' => $request->image,
        'disponibilite' => $request->disponibilite,
        'created_at' => now(),
        'updated_at' => now(),
        'id_proprietaire' => $userId, 
    ]);

    $annonces = Annonce::where('id_proprietaire', auth()->user()->id)->get();
    return view('proprietaire.annonceview', compact('annonces'));
}


public function edit($id)
{
    $annonce = Annonce::where('id', $id)->first();

   

    return view('proprietaire.annonceview', compact('annonce'));
}

public function destroy($id)
{
    $annonce = Annonce::where('id', $id)->first();

    $annonce->delete();

    return redirect()->route('annonce.proprietaire');
}

}
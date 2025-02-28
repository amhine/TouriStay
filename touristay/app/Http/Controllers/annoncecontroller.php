<?php

namespace App\Http\Controllers;
use App\Models\Annonce;
use Illuminate\Http\Request;
use App\Models\equipement;

class annoncecontroller extends Controller
{
    public function index()
    {
        $annonces = Annonce::all();
        $equipement = equipement::all();
        return view('annonceview',compact('annonces',"equipement"));
    }


public function filtrepag(Request $request)
{
   
    $ville = $request->input('ville');
    $chambres = $request->input('chambres');
    $prix = $request->input('prix');

    $annoncesQuery = Annonce::query();

    if ($ville) {
        $annoncesQuery->where('ville', $ville);
    }

    
    if ($chambres && $chambres != 'Toutes') {
        $annoncesQuery->where('nbrchambre', $chambres);
    }

    if ($prix && $prix != 'Tous') {
        if ($prix == '< 500 DH') {
            $annoncesQuery->where('prixparnuit', '<', 500);
        } elseif ($prix == '500 - 1000 DH') {
            $annoncesQuery->whereBetween('prixparnuit', [500, 1000]);
        } else {
            $annoncesQuery->where('prixparnuit', '>', 1000);
        }
    }

    $annonces = $annoncesQuery->paginate(9);  
    return view('annonces.index', compact('annonces'));
}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;
    protected $table = 'annonce';

    protected $fillable = [
        'titre', 
        'description', 
        'prixparnuit', 
        'nbrchambre', 
        'nbrsallesebain', 
        'adress', 
        'ville', 
        'image', 
        'disponibilite', 
        'created_at', 
        'updated_at',
        'id_proprietaire' 
    ];

    // public function equipement()
    // {
    //     return $this->belongsToMany(equipement::class, 'annonce_equipe');
    // }
    public function equipement()
    {
        return $this->belongsToMany(Equipement::class, 'annonce_equipe', 'annonce_id', 'equipe_id');
    }
    public function favoris()
    {
        return $this->belongsToMany(User::class, 'favories', 'id_annonce', 'id_touriste')->withTimestamps();
    }
    public function isFavorited()
    {
        if (auth()->check()) {
            return $this->favoris()->where('id_touriste', auth()->id())->exists();
        }
        return false;
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

}

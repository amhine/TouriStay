<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class annonce extends Model
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
    ];

    public function equipement()
    {
        return $this->belongsToMany(equipement::class, 'annonce_equipe');
    }
}

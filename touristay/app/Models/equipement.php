<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipement extends Model
{
    use HasFactory;
    protected $table = 'equipement';

    protected $fillable = [
        'nom', 
        'icon'
    ];
    public function annonces()
    {
        return $this->belongsToMany(annonce::class, 'annonce_equipe');
    }
}

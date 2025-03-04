<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['touriste_id', 'annonce_id', 'datedebut', 'datefin', 'status'];

    public function touristique()
    {
        return $this->belongsTo(user::class);
    }

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
    public function payment()
    {
        return $this->hasOne(paiement::class);
    }
}


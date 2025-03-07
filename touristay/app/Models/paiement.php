<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paiement extends Model
{
    use HasFactory;
    protected $table = 'paiement';
    protected $fillable = [
        'reservation_id',
        '"datepaiement"',
        'id_touriste',
        'status',
        'amount'
    ];
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    
}

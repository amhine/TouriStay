<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paiement extends Model
{
    use HasFactory;
    protected $table = 'paimente';
    protected $fillable = [
        'datePaiement '
    ];
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}

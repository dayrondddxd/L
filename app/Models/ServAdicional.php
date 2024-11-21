<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServAdicional extends Model
{
    use HasFactory;

    protected $casts=[
        'price'=>MoneyCast::class,
    ];

    public function reserv():BelongsTo
    {
        return $this->belongsTo(Reserva::class);
    }
}

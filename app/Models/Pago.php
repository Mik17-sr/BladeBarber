<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $primaryKey = 'id_pago';

    protected $fillable = [
        'id_cita',
        'monto',
        'metodo',
        'fecha_pago'
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita');
    }
}

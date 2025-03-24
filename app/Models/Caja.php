<?php

namespace App\Models;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'sucursal_id',
        'fecha_apertura',
        'fecha_cierre',
        'monto_inicial',
        'monto_final',
        'descripcion',
        'estado',
    ];

    //un arqueo puede tener muchos moviientos
    public function movimientos()
    {
        return $this->hasMany(MovimientoCaja::class);
    }
}

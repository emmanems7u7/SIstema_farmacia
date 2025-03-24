<?php

namespace App\Models;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class MovimientoCaja extends Model
{
    use HasFactory;
    protected $fillable = [
        'venta_id',
        'tipo',
        'monto',
        'descripcion',
        'fecha_movimiento',
        'caja_id',
    ];

    //un movimiento puede tener un arqueo
    public function caja()
    {
        return $this->belongsTo(Caja::class);
    }
    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id', 'venta_id');
    }

}

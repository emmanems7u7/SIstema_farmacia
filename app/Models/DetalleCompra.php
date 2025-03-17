<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{

    //
    public function compra()
    {
        return $this->belongsTo(Compra::class);

    }
    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class);

    }
    //   public function proveedor(){
    //     return $this->belongsTo(Proveedor::class);

    // }
    public function producto()
    {
        return $this->belongsTo(Producto::class);

    }
}

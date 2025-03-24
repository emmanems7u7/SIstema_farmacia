<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use App\Models\Caja;
use App\Models\DetalleVenta;
use App\Models\DetalleCompra;
use App\Models\MovimientoCaja;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cajas = Caja::all();
        return view('admin.cajas.index', compact('cajas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function ingresos(Request $request)
    {
        $sucursal = Sucursal::find(Auth::user()->sucursal_id);

        // Obtener fecha de búsqueda
        $fecha = $request->input('fecha');


        // Consulta con paginación
        $cajas = Caja::where('sucursal_id', $sucursal->id)
            ->where('estado', 0)
            ->when($fecha, function ($query) use ($fecha) {
                $query->whereHas('movimientos', function ($movimientosQuery) use ($fecha) {

                    $movimientosQuery->whereDate('fecha_movimiento', $fecha);

                });
            })
            ->paginate(perPage: 2); // Paginar por cajas

        $caja_movs = [];
        $totales_caja = [];

        foreach ($cajas as $caja) {
            $movimientos = MovimientoCaja::where('caja_id', $caja->id)->get();

            $total_monto = 0; // Inicializamos el total de la caja

            $movimientos_con_detalle = $movimientos->map(function ($movimiento) use (&$total_monto) {
                $detalle_ventas = collect(); // Inicializar como colección vacía

                switch ($movimiento->tipo) {
                    case 'venta':
                        $detalle_ventas = DetalleVenta::where('venta_id', $movimiento->venta_id)
                            ->with('producto')
                            ->get()
                            ->map(function ($detalle) {
                                return [
                                    'id' => $detalle->id,
                                    'cantidad' => $detalle->cantidad,
                                    'producto_precio' => $detalle->producto->precio_venta ?? 0,
                                    'producto_nombre' => $detalle->producto->nombre ?? 'Producto no encontrado',
                                ];
                            });
                        $total_monto += $movimiento->monto; // SUMAR si es una venta
                        break;

                    case 'compra':
                        $detalle_ventas = DetalleCompra::where('compra_id', $movimiento->venta_id)
                            ->with('producto')
                            ->get()
                            ->map(function ($detalle) {
                                return [
                                    'id' => $detalle->id,
                                    'cantidad' => $detalle->cantidad,
                                    'producto_precio' => $detalle->producto->precio_venta ?? 0,
                                    'producto_nombre' => $detalle->producto->nombre ?? 'Producto no encontrado',
                                ];
                            });
                        $total_monto -= $movimiento->monto; // RESTAR si es una compra
                        break;
                }

                $movimiento->detalle_ventas = $detalle_ventas;
                return $movimiento;
            });

            $caja_movs[$caja->id] = $movimientos_con_detalle;
            $totales_caja[$caja->id] = $total_monto; // Guardamos el total actualizado con compras restadas
        }

        // dd($caja_movs);
        return view('admin.cajas.ingresos', compact('caja_movs', 'totales_caja', 'cajas', 'fecha'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha_apertura' => 'required|date',
            'monto_inicial' => 'nullable|numeric|min:0',
            'descripcion' => 'nullable|string|max:255',
        ]);
        $sucursal = Sucursal::find(Auth::user()->sucursal_id);

        Caja::create([
            'sucursal_id' => $sucursal->id,
            'fecha_apertura' => $request->fecha_apertura,
            'fecha_cierre' => null,
            'monto_inicial' => $request->monto_inicial,
            'estado' => 1,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('admin.cajas.index')->with('success', 'Caja registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Caja $caja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Caja $caja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Caja $caja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Caja $caja)
    {
        //
    }
    public function cerrar($id)
    {
        $caja = Caja::find($id);
        $mov_cajas = MovimientoCaja::where('caja_id', $id)->get();

        $total = 0;
        foreach ($mov_cajas as $cajam) {
            $total = $total + $cajam->monto;
        }

        $caja->monto_final = $total;
        $caja->fecha_cierre = now();
        $caja->save();
        return redirect()->back()->with('success', 'Caja cerrada correctamente');
    }
}

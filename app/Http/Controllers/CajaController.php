<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use App\Models\Caja;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha_apertura' => 'required|date',
            'fecha_cierre' => 'nullable|date|after_or_equal:fecha_apertura',
            'monto_inicial' => 'nullable|numeric|min:0',
            'descripcion' => 'nullable|string|max:255',
        ]);
        $sucursal = Sucursal::find(Auth::user()->sucursal_id);

        Caja::create([
            'sucursal_id' => $sucursal->id,
            'fecha_apertura' => $request->fecha_apertura,
            'fecha_cierre' => $request->fecha_cierre,
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

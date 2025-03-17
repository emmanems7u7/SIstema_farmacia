<?php

namespace App\Http\Controllers;

use App\Models\User; // Importa el modelo User
use App\Models\Sucursal; // Si usas el modelo Sucursal, impórtalo también
use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Producto;

use App\Models\Venta;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    /**
     * Muestra la vista de administración principal.
     */
    public function index()
    {
       
        $total_productos = Producto::count();
        $total_compras = Compra::count();
        $total_clientes = Cliente::count();
        $compras = Compra::count();
        $total_ventas = Venta::count();

        $sucursal_id=Auth::check() ? Auth::user()->sucursal_id : redirect()->route('login')->send();
       // $sucursal_id = Auth::user()->sucursal_id;
        $sucursal = Sucursal::where('id',$sucursal_id)->first();
        return view('admin.index',compact(
            'sucursal',
            'total_productos',
            'total_compras',
            'total_clientes',
            'total_ventas',
            'compras'
        ));



       
        
    }

    /**
     * Crea un nuevo usuario.
     */
    public function crearUsuario()
    {
        // Obtén la sucursal correspondiente 
        $sucursal = Sucursal::first(); // obtiene la primera sucursal de la base de datos

        if (!$sucursal) {
            return "No se encontró ninguna sucursal.";
        }

        // Crear un nuevo usuario
        $usuario = new User();
        $usuario->name = "Admin";
        $usuario->email = $request->email; //  correo sea único
        $usuario->password = Hash::make($request['nombre']);  // Encripta la contraseña
        $usuario->sucursal_id = $sucursal->id; //  ID de la sucursal
        $usuario->save();

        return "Usuario creado con éxito";
    }
}
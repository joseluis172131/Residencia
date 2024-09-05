<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ingenieria_AdminModel;


class Ingenieria_AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = DB::select("SELECT * FROM ingenieria");
        return view('Ingenieria', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'txtnombre' => 'required|string|max:255',
            'txtcantidad' => 'required|integer',
            'txtcodigo' => 'required|string|max:255|unique:ingenieria,codigo',
            'txtestatus' => 'required|string|max:255',
            'txtsubarea' => 'required|string|max:255',
            'txtnumeroParte' => 'nullable|string|max:50',
            'txtimagen' => 'nullable|image|max:2048'
        ], [
            'txtcodigo.unique' => 'El código ya existe por favor, ingrese un código diferente.'
        ]);
    
        // Crear una nueva instancia del modelo y guardar los datos
        $ingenieria = new Ingenieria_AdminModel([
            'nombreherramienta' => $request->txtnombre,
            'cantidad' => $request->txtcantidad,
            'codigo' => $request->txtcodigo,
            'disponibilidad'=> $request->txtestatus,
            'sub_area' => $request->txtsubarea,
            'numeroParte' => $request->input('txtnumeroParte'),
            'imagen' => $request->hasFile('txtimagen') ? $request->file('txtimagen')->store('images') : null,
        ]);
    
        if ($request->hasFile('txtimagen')) {
            $imagePath = $request->file('txtimagen')->store('images', 'public');
            $ingenieria->imagen = $imagePath;
        }
    
        // Guardar el registro
        $ingenieria->save();
    
        // Retornar con un mensaje de éxito
        return back()->with('correcto', 'Producto registrado correctamente');
    }

    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $request->validate([
            'txtnombre' => 'required|string|max:255',
            'txtcantidad' => 'required|integer',
            'txtcodigo' => 'required|string|max:255',
            'txtestatus' => 'required|string|max:255',
            'txtsubarea' => 'required|string|max:255',
            'txtnumeroParte' => 'nullable|string|max:50',
            'txtimagen' => 'nullable|image|max:2048' // Validación para imágenes si es necesario
        ]);
    
        try {
            // Buscar la herramienta por ID y actualizar sus campos
            $ingenieria = Ingenieria_AdminModel::findOrFail($id);
            $ingenieria->nombreherramienta = $request->input('txtnombre');
            $ingenieria->cantidad = $request->input('txtcantidad');
            $ingenieria->codigo = $request->input('txtcodigo');
            $ingenieria->disponibilidad = $request->input('txtestatus');
            $ingenieria->sub_area = $request->input('txtsubarea');
            $ingenieria->numeroParte = $request->input('txtnumeroParte');
    
            // Comprobar si se subió una nueva imagen
            if ($request->hasFile('txtimagen')) {
                $imagePath = $request->file('txtimagen')->store('images', 'public');
                $ingenieria->imagen = $imagePath;
            } else {
                // Usar la imagen existente si no se sube una nueva
                $ingenieria->imagen = $request->input('existingImage');
            }
    
            // Guardar los cambios en la base de datos
            $ingenieria->save();
    
            return back()->with('correcto', 'Producto editado correctamente');
        } catch (\Throwable $th) {
            // Manejo de excepciones
            return back()->with('incorrecto', 'Error al modificar');
        }
    }
        public function destroy($id)
    {
        try {
            // Encontrar la herramienta por ID y eliminarla
            $ingenieria = Ingenieria_AdminModel::findOrFail($id);
            $ingenieria->delete();

            // Redirigir con un mensaje de éxito
            return back()->with('correcto', 'Producto eliminado correctamente');
        } catch (\Exception $e) {
            // Redirigir con un mensaje de error en caso de excepción
            return back()->with('incorrecto', 'Error al eliminar el producto');
        }
    }

}

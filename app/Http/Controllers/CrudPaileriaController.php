<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Herramienta;

class CrudPaileriaController extends Controller
{
    public function index()
    {
        $datos = DB::select("SELECT * FROM paileria");
        return view('welcome', compact('datos'));
    }

    public function create(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'txtnombre' => 'required|string|max:255',
            'txtcantidad' => 'required|integer',
            'txtcodigo' => 'required|string|max:255',
            'txtestatus' => 'required|string|max:255',
            'txtsubarea' => 'required|string|max:255',
            'txtimagen' => 'nullable|image|max:2048'  // Validación para imágenes si es necesario
        ]);

        // Crear una nueva instancia del modelo y guardar los datos
        $herramienta = new Herramienta([
            'nombreherramienta' => $request->txtnombre,
            'cantidad' => $request->txtcantidad,
            'codigo' => $request->txtcodigo,
            'disponibilidad'=> $request->txtestatus,
            'sub_area' => $request->txtsubarea,
            'imagen' => $request->hasFile('txtimagen') ? $request->file('txtimagen')->store('images') : null, // Manejo de archivo si es necesario
        ]);

        if ($request->hasFile('txtimagen')) {
            $imagePath = $request->file('txtimagen')->store('images', 'public');
            $herramienta->imagen = $imagePath;
        }


        if ($herramienta->save()) {
            return back()->with('correcto', 'Producto registrado correctamente');
        } else {
            return back()->with('incorrecto', 'Error al registrar');
        }
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
            'txtimagen' => 'nullable|image|max:2048' // Validación para imágenes si es necesario
        ]);
    
        try {
            // Buscar la herramienta por ID y actualizar sus campos
            $herramienta = Herramienta::findOrFail($id);
            $herramienta->nombreherramienta = $request->input('txtnombre');
            $herramienta->cantidad = $request->input('txtcantidad');
            $herramienta->codigo = $request->input('txtcodigo');
            $herramienta->disponibilidad = $request->input('txtestatus');
            $herramienta->sub_area = $request->input('txtsubarea');
    
            // Comprobar si se subió una nueva imagen
            if ($request->hasFile('txtimagen')) {
                $imagePath = $request->file('txtimagen')->store('images', 'public');
                $herramienta->imagen = $imagePath;
            } else {
                // Usar la imagen existente si no se sube una nueva
                $herramienta->imagen = $request->input('existingImage');
            }
    
            // Guardar los cambios en la base de datos
            $herramienta->save();
    
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
            $herramienta = Herramienta::findOrFail($id);
            $herramienta->delete();

            // Redirigir con un mensaje de éxito
            return back()->with('correcto', 'Producto eliminado correctamente');
        } catch (\Exception $e) {
            // Redirigir con un mensaje de error en caso de excepción
            return back()->with('incorrecto', 'Error al eliminar el producto');
        }
    }

}

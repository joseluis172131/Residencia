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
        // Validar la solicitud con un mensaje de error personalizado para el campo 'codigo'
        $request->validate([
            'txtnombre' => 'required|string|max:255',
            'txtcantidad' => 'required|integer',
            'txtestatus' => 'required|string|max:255',
            'txtsubarea' => 'required|string|max:255',
            'txtnumeroParte' => 'nullable|string|max:50',
            'txtimagen' => 'nullable|image|max:2048',
        ]);
    
        // Generar automáticamente el código (con prefijo PRIN- y número secuencial)
        // Obtener el último código registrado en la base de datos
        $ultimoCodigo = Ingenieria_AdminModel::where('codigo', 'like', 'PRIN-%')
                                   ->orderByDesc('codigo')
                                   ->first();
    
        // Si no hay registros previos, empezar con PRIN-001
        if ($ultimoCodigo) {
            // Extraer el número del último código (quitar el prefijo 'PRIN-')
            $numeroSecuencial = (int) substr($ultimoCodigo->codigo, 5);  // "PRIN-" tiene 5 caracteres
            $nuevoNumeroSecuencial = $numeroSecuencial + 1;  // Incrementar el número
        } else {
            // Si no hay ningún código, iniciar con 001
            $nuevoNumeroSecuencial = 1;
        }
    
        // Formatear el nuevo código con 3 dígitos
        $nuevoCodigo = 'PRIN-' . str_pad($nuevoNumeroSecuencial, 3, '0', STR_PAD_LEFT);
    
        // Crear una nueva instancia del modelo y guardar los datos
        $ingenieria = new Ingenieria_AdminModel([
            'nombreherramienta' => $request->txtnombre,
            'cantidad' => $request->txtcantidad,
            'codigo' => $nuevoCodigo,  // Asignar el código generado automáticamente
            'disponibilidad' => $request->txtestatus,
            'sub_area' => $request->txtsubarea,
            'numeroParte' => $request->input('txtnumeroParte'),
            'imagen' => $request->hasFile('txtimagen') ? $request->file('txtimagen')->store('images', 'public') : null,
        ]);
    
        // Guardar el registro en la base de datos
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
            // Encontrar la herramienta por ID y obtener su código
            $ingenieria = Ingenieria_AdminModel::findOrFail($id);
            $codigoEliminar = $ingenieria->codigo;  // Usar el código correcto
    
            // Eliminar la herramienta
            $ingenieria->delete();
    
          
    
            // Redirigir con un mensaje de éxito
            return back()->with('correcto', 'Producto eliminado correctamente');
        } catch (\Exception $e) {
            // Redirigir con un mensaje de error en caso de excepción
            return back()->with('incorrecto', 'Error al eliminar el producto');
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Almacen_AdminModel;

class Almacen_AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = DB::select("SELECT * FROM almacen");
        return view('almacen', compact('datos'));
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
    
        // Generar automáticamente el código (con prefijo PRAL- y número secuencial)
        // Obtener el último código registrado en la base de datos
        $ultimoCodigo = Almacen_AdminModel::where('codigo', 'like', 'PRAL-%')
                                       ->orderByDesc('codigo')
                                       ->first();
    
        // Si no hay registros previos, empezar con PRAL-001
        if ($ultimoCodigo) {
            // Extraer el número del último código (quitar el prefijo 'PRAL-')
            $numeroSecuencial = (int) substr($ultimoCodigo->codigo, 5);  // "PRAL-" tiene 5 caracteres
            $nuevoNumeroSecuencial = $numeroSecuencial + 1;  // Incrementar el número
        } else {
            // Si no hay ningún código, iniciar con 001
            $nuevoNumeroSecuencial = 1;
        }
    
        // Formatear el nuevo código con 3 dígitos
        $nuevoCodigo = 'PRAL-' . str_pad($nuevoNumeroSecuencial, 3, '0', STR_PAD_LEFT);
    
        // Crear una nueva instancia del modelo y guardar los datos
        $almacen = new Almacen_AdminModel([
            'nombreherramienta' => $request->txtnombre,
            'cantidad' => $request->txtcantidad,
            'codigo' => $nuevoCodigo,  // Asignar el código generado automáticamente
            'disponibilidad' => $request->txtestatus,
            'sub_area' => $request->txtsubarea,
            'numeroParte' => $request->input('txtnumeroParte'),
            'imagen' => $request->hasFile('txtimagen') ? $request->file('txtimagen')->store('images', 'public') : null,
        ]);
    
        // Guardar el registro en la base de datos
        $almacen->save();
    
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
            $almacen = Almacen_AdminModel::findOrFail($id);
            $almacen->nombreherramienta = $request->input('txtnombre');
            $almacen->cantidad = $request->input('txtcantidad');
            $almacen->codigo = $request->input('txtcodigo');
            $almacen->disponibilidad = $request->input('txtestatus');
            $almacen->sub_area = $request->input('txtsubarea');
            $almacen->numeroParte = $request->input('txtnumeroParte');
    
            // Comprobar si se subió una nueva imagen
            if ($request->hasFile('txtimagen')) {
                $imagePath = $request->file('txtimagen')->store('images', 'public');
                $almacen->imagen = $imagePath;
            } else {
                // Usar la imagen existente si no se sube una nueva
                $almacen->imagen = $request->input('existingImage');
            }
    
            // Guardar los cambios en la base de datos
            $almacen->save();
    
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
            $almacen = Almacen_AdminModel::findOrFail($id);
            $codigoEliminar = $almacen->codigo;  // Usar el código correcto
    
            // Eliminar la herramienta
            $almacen->delete();
    
          
    
            // Redirigir con un mensaje de éxito
            return back()->with('correcto', 'Producto eliminado correctamente');
        } catch (\Exception $e) {
            // Redirigir con un mensaje de error en caso de excepción
            return back()->with('incorrecto', 'Error al eliminar el producto');
        }
    }
}    
    
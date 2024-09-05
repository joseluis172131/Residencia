<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Oficina_AdminModel;

class Oficina_AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = DB::select("SELECT * FROM oficina_administrativa");
        return view('oficina', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'txtnombre' => 'required|string|max:255',
            'txtcantidad' => 'required|integer',
            'txtcodigo' => 'required|string|max:255|unique:oficina_administrativa,codigo',
            'txtestatus' => 'required|string|max:255',
            'txtsubarea' => 'required|string|max:255',
            'txtnumeroParte' => 'nullable|string|max:50',
            'txtimagen' => 'nullable|image|max:2048' 
        ], [
            'txtcodigo.unique' => 'El código ya existe por favor, ingrese un código diferente.'
        ]);

        $oficina = new Oficina_AdminModel([
            'nombreherramienta' => $request->txtnombre,
            'cantidad' => $request->txtcantidad,
            'codigo' => $request->txtcodigo,
            'disponibilidad'=> $request->txtestatus,
            'sub_area' => $request->txtsubarea,
            'numeroParte' => $request->input('txtnumeroParte'),
            'imagen' => $request->hasFile('txtimagen') ? $request->file('txtimagen')->store('images') : null, // Manejo de archivo si es necesario
        ]);

        if ($request->hasFile('txtimagen')) {
            $imagePath = $request->file('txtimagen')->store('images', 'public');
            $oficina->imagen = $imagePath;
        }


        $oficina->save();
    
        // Retornar con un mensaje de éxito
        return back()->with('correcto', 'Producto registrado correctamente');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'txtnombre' => 'required|string|max:255',
            'txtcantidad' => 'required|integer',
            'txtcodigo' => 'required|string|max:255',
            'txtestatus' => 'required|string|max:255',
            'txtsubarea' => 'required|string|max:255',
            'txtnumeroParte' => 'nullable|string|max:50',
            'txtimagen' => 'nullable|image|max:2048'
        ]);
    
        try {
            // Buscar la herramienta por ID y actualizar sus campos
            $oficina = Oficina_AdminModel::findOrFail($id);
            $oficina->nombreherramienta = $request->input('txtnombre');
            $oficina->cantidad = $request->input('txtcantidad');
            $oficina->codigo = $request->input('txtcodigo');
            $oficina->disponibilidad = $request->input('txtestatus');
            $oficina->sub_area = $request->input('txtsubarea');
            $oficina->numeroParte = $request->input('txtnumeroParte');
    
            // Comprobar si se subió una nueva imagen
            if ($request->hasFile('txtimagen')) {
                $imagePath = $request->file('txtimagen')->store('images', 'public');
                $oficina->imagen = $imagePath;
            } else {
                // Usar la imagen existente si no se sube una nueva
                $oficina->imagen = $request->input('existingImage');
            }
    
            // Guardar los cambios en la base de datos
            $oficina->save();
    
            return back()->with('correcto', 'Producto editado correctamente');
        } catch (\Throwable $th) {
            // Manejo de excepciones
            return back()->with('incorrecto', 'Error al modificar');
        }
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Encontrar la herramienta por ID y eliminarla
            $oficina = Oficina_AdminModel::findOrFail($id);
            $oficina->delete();

            // Redirigir con un mensaje de éxito
            return back()->with('correcto', 'Producto eliminado correctamente');
        } catch (\Exception $e) {
            // Redirigir con un mensaje de error en caso de excepción
            return back()->with('incorrecto', 'Error al eliminar el producto');
        }
    }
}

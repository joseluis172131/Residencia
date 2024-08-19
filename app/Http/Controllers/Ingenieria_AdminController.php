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
        $request->validate([
            'txtnombre' => 'required|string|max:255',
            'txtcantidad' => 'required|integer',
            'txtcodigo' => 'required|string|max:255',
            'txtestatus' => 'required|string|max:255',
            'txtsubarea' => 'required|string|max:255',
            'txtimagen' => 'nullable|image|max:2048' 
        ]);

        $ingenieria = new Ingenieria_AdminModel([
            'Nombre' => $request->txtnombre,
            'Cantidad' => $request->txtcantidad,
            'codigo' => $request->txtcodigo,
            'disponibilidad'=> $request->txtestatus,
            'sub_area' => $request->txtsubarea,
            'imagen' => $request->hasFile('txtimagen') ? $request->file('txtimagen')->store('images') : null, // Manejo de archivo si es necesario
        ]);

        if ($request->hasFile('txtimagen')) {
            $imagePath = $request->file('txtimagen')->store('images', 'public');
            $ingenieria->imagen = $imagePath;
        }


        if ($ingenieria->save()) {
            return back()->with('correcto', 'Producto registrado correctamente');
        } else {
            return back()->with('incorrecto', 'Error al registrar');
        }
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
            'txtimagen' => 'nullable|image|max:2048'
        ]);

        try {
            // Buscar la herramienta por ID y actualizar sus campos
            $ingenieria = Ingenieria_AdminModel::findOrFail($id);
            $ingenieria->Nombre = $request->input('txtnombre');
            $ingenieria->Cantidad = $request->input('txtcantidad');
            $ingenieria->codigo = $request->input('txtcodigo');
            $ingenieria->disponibilidad = $request->input('txtestatus');
            $ingenieria->sub_area = $request->input('txtsubarea');
    
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
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

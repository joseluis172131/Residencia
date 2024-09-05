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
        $request->validate([
            'txtnombre' => 'required|string|max:255',
            'txtcantidad' => 'required|integer',
            'txtcodigo' => 'required|string|max:255|unique:almacen,codigo',
            'txtestatus' => 'required|string|max:255',
            'txtsubarea' => 'required|string|max:255',
            'txtnumeroParte' => 'nullable|string|max:50',
            'txtimagen' => 'nullable|image|max:2048'
        ], [
            'txtcodigo.unique' => 'El código ya existe por favor, ingrese un código diferente.'
        ]);

        $almacen = new Almacen_AdminModel([
            'nombreherramienta' => $request->input('txtnombre'),
            'cantidad' => $request->input('txtcantidad'),
            'codigo' => $request->input('txtcodigo'),
            'disponibilidad' => $request->input('txtestatus'),
            'sub_area' => $request->input('txtsubarea'),
            'numeroParte' => $request->input('txtnumeroParte'),
            'imagen' => $request->hasFile('txtimagen') ? $request->file('txtimagen')->store('images', 'public') : null,
        ]);

        $almacen->save();
    
        // Retornar con un mensaje de éxito
        return back()->with('correcto', 'Producto registrado correctamente');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Implementa la lógica de almacenamiento si es necesario
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implementa la lógica para mostrar un recurso específico si es necesario
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Implementa la lógica para mostrar el formulario de edición si es necesario
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
            $almacen = Almacen_AdminModel::findOrFail($id);
            $almacen->nombreherramienta = $request->input('txtnombre');
            $almacen->cantidad = $request->input('txtcantidad');
            $almacen->codigo = $request->input('txtcodigo');
            $almacen->disponibilidad = $request->input('txtestatus');
            $almacen->sub_area = $request->input('txtsubarea');
            $almacen->numeroParte = $request->input('txtnumeroParte');
    
            if ($request->hasFile('txtimagen')) {
                $imagePath = $request->file('txtimagen')->store('images', 'public');
                $almacen->imagen = $imagePath;
            } else {
                // Mantener la imagen existente si no se sube una nueva
                $almacen->imagen = $request->input('existingImage');
            }
    
            $almacen->save();
    
            return back()->with('correcto', 'Producto editado correctamente');
        } catch (\Throwable $th) {
            return back()->with('incorrecto', 'Error al modificar');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $almacen = Almacen_AdminModel::findOrFail($id);
            $almacen->delete();
    
            return back()->with('correcto', 'Producto eliminado correctamente');
        } catch (\Exception $e) {
            return back()->with('incorrecto', 'Error al eliminar el producto');
        }
    }
}

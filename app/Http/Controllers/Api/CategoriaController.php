<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all(); // select * from categorias
        return response()->json($categorias, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validación
        $request->validate([
            "nombre" => "required|unique:categorias|max:50|min:2"
        ]);
        // guardar
        $categoria = new Categoria;
        $categoria->nombre = $request->nombre;
        $categoria->detalle = $request->detalle;
        $categoria->save(); 

        // return redirect("/categoria");

        return response()->json([
            "status" => 1,
            "mensaje" => "Categoria Registrada",
            "error" => false
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::FindOrFail($id);

        return response()->json([
            "status" => 1,
            "data" => $categoria,
            "error" => false
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::FindOrFail($id);

        $categoria->nombre = $request->nombre;
        $categoria->detalle = $request->detalle;
        $categoria->save();

        return response()->json([
            "status" => 1,
            "mensaje" => "Categoria modificada",
            "error" => false
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::FindOrFail($id);
        $categoria->delete();

        return response()->json([
            "status" => 1,
            "mensaje" => "Categoria eliminada",
            "error" => false
        ], 200);
    }
}

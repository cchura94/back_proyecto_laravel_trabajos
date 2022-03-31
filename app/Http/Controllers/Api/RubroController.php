<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rubro;

class RubroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rubros = Rubro::all();
        return response()->json($rubros, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "nombre" => "required|unique:rubros",
            "estado" => "required"
        ]);
        // guardar
        $rubro = new Rubro;
        $rubro->nombre = $request->nombre;
        $rubro->detalle = $request->detalle;
        $rubro->estado = $request->estado;
        $rubro->save();

        // responder
        return response()->json([
                                    "mensaje" => "el rubro ha sido registrado",
                                    "status" => 1,
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
        $rubro = Rubro::FindOrFail($id);

        return response()->json([
            "status" => 1,
            "data" => $rubro,
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
        $request->validate([
            "nombre" => "required|unique:rubros,nombre,$id"
        ]);

        $rubro = Rubro::FindOrFail($id);

        $rubro->nombre = $request->nombre;
        $rubro->detalle = $request->detalle;
        $rubro->estado = $request->estado;
        $rubro->save();

        return response()->json([
            "status" => 1,
            "mensaje" => "rubro modificado",
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
        $rubro = Rubro::FindOrFail($id);
        $rubro->delete();

        return response()->json([
            "status" => 1,
            "mensaje" => "Rubro eliminada",
            "error" => false
        ], 200);
    }
}

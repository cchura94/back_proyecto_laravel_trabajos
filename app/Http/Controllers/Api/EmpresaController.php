<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::paginate();
        return response()->json($empresas, 200);
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
            "nombre" => "required|unique:empresas",
            "pais" => "required|max:20"
        ]);

        // subir imagen
        $img_logo = "";

        // guardar
        $empresa = new Empresa;
        $empresa->nombre = $request->nombre;
        $empresa->sitio_web = $request->sitio_web;
        $empresa->direccion = $request->direccion;
        $empresa->ciudad = $request->ciudad;
        $empresa->pais = $request->pais;
        $empresa->descripcion = $request->descripcion;
        $empresa->telefono = $request->telefono;
        $empresa->nombre_contacto = $request->nombre_contacto;
        $empresa->logo = $img_logo;
        $empresa->save();
        // responder
        return response()->json([
            "status" => 1,
            "mensaje" => "Empresa Registrada",
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
        $empresa = Empresa::FindOrFail($id);
        return response()->json([
            "status" => 1,
            "data" => $empresa,
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
         // validar
         $request->validate([
            "nombre" => "required|unique:empresas,nombre,$id",
            "pais" => "required|max:20"
        ]);

        // subir imagen
        $img_logo = "";

        // guardar
        $empresa = Empresa::FindOrFail($id);
        $empresa->nombre = $request->nombre;
        $empresa->sitio_web = $request->sitio_web;
        $empresa->direccion = $request->direccion;
        $empresa->ciudad = $request->ciudad;
        $empresa->pais = $request->pais;
        $empresa->descripcion = $request->descripcion;
        $empresa->telefono = $request->telefono;
        $empresa->nombre_contacto = $request->nombre_contacto;
        $empresa->logo = $img_logo;
        $empresa->save();
        // responder
        return response()->json([
            "status" => 1,
            "mensaje" => "Empresa Modificada",
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
        $empresa = Empresa::FindOrFail($id);
        $empresa->delete();

        return response()->json([
            "status" => 1,
            "mensaje" => "Empresa eliminada",
            "error" => false
        ], 200);
    }
}

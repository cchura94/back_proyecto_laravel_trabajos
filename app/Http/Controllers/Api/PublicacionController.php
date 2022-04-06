<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Auth;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = ($request->limit)?$request->limit:2;
        
        $publicaciones = Publicacion::with('categoria')
                                    ->with('empresa')
                                    ->select('titulo', 'nivel', 'categoria_id', 'empresa_id', 'id', 'salario')
                                    ->paginate($limit);
        return response()->json($publicaciones, 200);
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
            "titulo" => "required",
            "tipo" => "required",
            "descripcion" => "required",
            "empresa_id" => "required",
            "categoria_id" => "required",
            //"persona_id" => "required"
        ]);
        // guardar
        $publicacion = new Publicacion();
        $publicacion->titulo = $request->titulo;
        $publicacion->tipo = $request->tipo;
        $publicacion->nivel = $request->nivel;
        $publicacion->descripcion = $request->descripcion;
        $publicacion->requerimientos = $request->requerimientos;
        $publicacion->salario = $request->salario;
        $publicacion->ubicacion = $request->ubicacion;
        if($request->estado){

            $publicacion->estado = $request->estado;
        }
        $publicacion->empresa_id = $request->empresa_id;
        $publicacion->categoria_id = $request->categoria_id;
        $publicacion->persona_id = 1;
        $publicacion->ubicacion = $request->ubicacion;
        $publicacion->save();
        // responder
        
        return response()->json([
            "status" => 1,
            "mensaje" => "Publicacion registrada",
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
        $publicacion = Publicacion::FindOrFail($id);

        return response()->json([
            "status" => 1,
            "data" => $publicacion,
            "error" => false
        ], 200);  
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
            "titulo" => "required",
            "tipo" => "required",
            "descripcion" => "required",
            "empresa_id" => "required",
            "categoria_id" => "required",
            "persona_id" => "required"
        ]);
        // modificar
        $publicacion = Publicacion::FindOrFail($id);
        $publicacion->titulo = $request->titulo;
        $publicacion->tipo = $request->tipo;
        $publicacion->nivel = $request->nivel;
        $publicacion->descripcion = $request->descripcion;
        $publicacion->requerimientos = $request->requerimientos;
        $publicacion->salario = $request->salario;
        $publicacion->ubicacion = $request->ubicacion;
        $publicacion->estado = $request->estado;
        $publicacion->empresa_id = $request->empresa_id;
        $publicacion->categoria_id = $request->categoria_id;
        $publicacion->persona_id = $request->persona_id;
        $publicacion->ubicacion = $request->ubicacion;
        $publicacion->save();
        // responder
        
        return response()->json([
            "status" => 1,
            "mensaje" => "Publicacion Modificada",
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
        $publicacion = Publicacion::FindOrFail($id);
        $publicacion->delete();

        return response()->json([
            "status" => 1,
            "mensaje" => "Publicacion Eliminada",
            "error" => false
        ], 200);
    }
}

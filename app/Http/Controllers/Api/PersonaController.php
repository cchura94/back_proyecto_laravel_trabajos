<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $persona = Persona::paginate();
         return response()->json($persona, 200);
        
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
            "nombres" => "required|max:30",
            "apellidos" => "required|max:50",
            "ci_nit" => "max:15",
            "tel_cel" => "max:15",
            "user_id" => "required"
        ]);
        // guardar
        $persona = new Persona();
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->ci_nit = $request->ci_nit;
        $persona->tel_cel = $request->tel_cel;
        $persona->direccion = $request->direccion;
        $persona->save();
        // responder

        return response()->json([
            "status" => 1,
            "mensaje" => "Persona Registrada",
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
         $persona= Persona::find($id);
         return response()->json([
            "status" => 1,
            "data" => $persona,
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
            "nombres" => "required|max:30",
            "apellidos" => "required|max:50",
            "ci_nit" => "max:15",
            "tel_cel" => "max:15",
            "user_id" => "required"
        ]);
        // guardar
        $persona = Persona::FindOrFail($id);
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->ci_nit = $request->ci_nit;
        $persona->tel_cel = $request->tel_cel;
        $persona->direccion = $request->direccion;
        $persona->save();
        // responder

        return response()->json([
            "status" => 1,
            "mensaje" => "Persona Registrada",
            "error" => false
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::FindOrFail($id);
        $persona->delete();

        return response()->json([
            "status" => 1,
            "mensaje" => "persona eliminada",
            "error" => false
        ], 200);
    }
}

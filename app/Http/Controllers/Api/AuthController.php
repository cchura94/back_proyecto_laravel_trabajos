<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validar
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        // verificar
        $user = User::where("email", "=", $request->email)->first();
        if(isset($user->id)){
            if(Hash::check($request->password, $user->password)){
                // generar el token con sactum
                $token = $user->createToken("auth_token")->plainTextToken;
                return response()->json([
                    "status" => 1,
                    "mensaje" => "Usuario logueado",
                    "user" => $user,
                    "error" => false,
                    "access_token" => $token
                ], 200);

            }else{
                return response()->json([
                    "status" => 0,
                    "mensaje" => "La contraseña es incorrecta",
                    "error" => true
                ], 404);
            }
        }else{
            return response()->json([
                "status" => 0,
                "mensaje" => "Credenciales incorrectas",
                "error" => true
            ], 404);
        }
        // responder        
    }

    public function registro(Request $request)
    {
        // validar
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed"
        ]);

        // guardar
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        // responder        
        return response()->json([
            "status" => 1,
            "mensaje" => "Usuario registrado",
            "error" => false
        ], 201);
    }

    public function perfil()
    {
        // verificamos y respondemos
        
    }

    public function salir()
    {
        // verificamos y respondemos
        
    }
}

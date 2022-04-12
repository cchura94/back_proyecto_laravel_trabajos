<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_create_user()
    {
        $datos = [
            "name" => "prueba2_nombre",
            "email" => "prueba2@mail.com",
            "password" => "prueba1321",
            "password_confirmation" => "prueba1321"
        ];

        $response = $this->post("/api/v1/auth/registro", $datos);

        $response->assertStatus(201)
        ->assertJson([
            "status" => 1,
            "mensaje" => "Usuario registrado",
            "error" => false
        ]);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\MigrateFreshSeedOnce;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseMigrations;
    public $userData=[
        "name" => "John Doe",
        "email" => "doe@example.com",
        "password" => "demo12345",
        "confirm_password" => "demo12345"
    ];
    /**
     * A basic feature test example.
     */
    
    public function test_register_required_field_validation(): void
    {
        $response = $this->json('POST', 'api/register', ['Accept' => 'application/json']) ;
       // dd($response);
        $response->assertStatus(Response::HTTP_BAD_REQUEST); 
        

        $response->assertJson([
            "success" => false,
            "message" => "Validation errors",
            "data" => [
                "name" => ["The name field is required."],
                "email" => ["The email field is required."],
                "password" => ["The password field is required."],
                "confirm_password"=>[ "The confirm password field is required."]
            ]
        ]);
    }
    public function test_password_matching(){

    }
    public function test_register(){
        $response = $this->json('POST', 'api/register',$this->userData, ['Accept' => 'application/json']) ;
        dd($response);
       //  $response->assertStatus(Response::HTTP_BAD_REQUEST); 
         
 
    }
}

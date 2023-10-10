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
    public $userData = [
        "name" => "John Doe",
        "email" => "doe@example.com",
        "password" => "demo12345",
        "confirm_password" => "demo12345"
    ];

    /**
     * Test a successful user registration.
     */

    public function test_user_register()
    {
        $response = $this->json('POST', 'api/register', $this->userData, ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'token',
                    'name',
                ],
            ]);
    }

    /**
     * Test a successful user login.
     */

    public function test_user_login()
    {
        //Create a user
        $this->json('POST', 'api/register', $this->userData, ['Accept' => 'application/json']);

        $response = $this->json('POST', 'api/login', $this->userData, ['Accept' => 'application/json']);
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => 'User login successfully.',
            ]);
    }

    /**
     * Test validation for registration with missing data.
     */
    public function test_register_validation()
    {
        $response = $this->json('POST', '/api/register', [], ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'success' => false,
                'message' => 'Validation errors',
            ])
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email',
                    'password',
                    'confirm_password',
                ]
            ]);
    }

    /**
     * Test validation for login with missing data.
     */
    public function test_login_validation()
    {
        $response = $this->json('POST', '/api/login', [], ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'success' => false,
                'message' => 'Validation errors',
            ])
            ->assertJsonStructure([
                'data' => [
                    'email',
                    'password',
                ]
            ]);
    }
}

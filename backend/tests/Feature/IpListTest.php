<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IpListTest extends TestCase
{
    use DatabaseMigrations;
    public $userData = [
        "name" => "John Doe",
        "email" => "doe@example.com",
        "password" => "demo12345",
        "confirm_password" => "demo12345"
    ];
    public $ipData = [

        "ip_address" => "10.23.33.33",
        "label" => "google.com"
    ];
    public $ipData1 = [

        "ip_address" => "10.23.33.34",
        "label" => "thread.com"
    ];
    public $ipData2 = [

        "ip_address" => "10.23.33.35",
        "label" => "facebook.com"
    ];
    public $ipData3 = [

        "ip_address" => "10.23.33.36",
        "label" => "twitter.com"
    ];
    public $updatedIpListData = [
        "ip_address" => "10.23.33.33",

        "label" => 'googly.com'
    ];
    public function test_iplist_creation(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->json('POST', 'api/ip_lists', $this->ipData, ['Accept' => 'application/json']);
        $response->assertStatus(Response::HTTP_OK)->assertJsonStructure([
            'data' => [
                'ip_address',
                'label',
                'updated_at'
            ],
        ]);
    }
    public function test_iplist_updation(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->json('POST', 'api/ip_lists', $this->ipData, ['Accept' => 'application/json'])->json();
        $id = $response['data']['id'];
        //   dd($id);
        $response_update_ip = $this->json('PUT', "api/ip_lists/{$id}", $this->updatedIpListData, ['Accept' => 'application/json']);

        $response_update_ip->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('ip_lists', $this->updatedIpListData);
    }
    public function test_iplist_show(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->json('POST', 'api/ip_lists', $this->ipData1, ['Accept' => 'application/json'])->json();
        //  $response->assertStatus(Response::HTTP_OK);
        $id = $response['data']['id'];
        $response_iplist = $this->json('GET', "api/ip_lists/{$id}", ['Accept' => 'application/json']);
        $response_iplist->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'ip_address',
                    'label',
                ]
            ]);
    }
    public function test_iplist_listing(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->json('POST', 'api/ip_lists', $this->ipData1, ['Accept' => 'application/json']);
        //  $response->assertStatus(Response::HTTP_OK);
        $this->json('POST', 'api/ip_lists', $this->ipData2, ['Accept' => 'application/json']);
        $this->json('POST', 'api/ip_lists', $this->ipData3, ['Accept' => 'application/json']);

        $response = $this->json('GET', "api/ip_lists", ['Accept' => 'application/json']);
        $response->assertStatus(Response::HTTP_OK);
        $response_data = $response->json();
        $this->assertCount(3, $response_data['data']);
    }


    public function test_iplist_validation()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->json('POST', '/api/ip_lists', [], ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'success' => false,
                'message' => 'Validation errors',
            ])
            ->assertJsonStructure([
                'data' => [
                    'ip_address',
                    'label',
                ]
            ]);
    }
    public function test_iplist_update_validation()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->json('POST', 'api/ip_lists', $this->ipData, ['Accept' => 'application/json'])->json();
        $id = $response['data']['id'];
        $response_update_ip = $this->json('PUT', "api/ip_lists/{$id}", [], ['Accept' => 'application/json']);

        $response_update_ip->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'success' => false,
                'message' => 'Validation errors',
            ])
            ->assertJsonStructure([
                'data' => [
                    'ip_address',
                    'label',
                ]
            ]);
    }
}

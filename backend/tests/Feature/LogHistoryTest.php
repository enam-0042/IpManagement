<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogHistoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use DatabaseMigrations;

     public $userData=[
        "name" => "John Doe",
        "email" => "doe@example.com",
        "password" => "demo12345",
        "confirm_password" => "demo12345"
    ];
    public $ipData=[
       
        "ip_address"=>"10.23.33.33" ,
        "label"=>"google.com"
    ];  
    public $ipData1=[
       
        "ip_address"=>"10.23.33.34" ,
        "label"=>"thread.com"
    ];
    public $ipData2=[
       
        "ip_address"=>"10.23.33.35" ,
        "label"=>"facebook.com"
    ];
    public $ipData3=[
       
        "ip_address"=>"10.23.33.36" ,
        "label"=>"twitter.com"
    ];
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_loghistories():void
    {
        Sanctum::actingAs(User::factory()->create());
    
        $this->json('POST', 'api/ip_lists', $this->ipData1, ['Accept' => 'application/json']);
      //  $response->assertStatus(Response::HTTP_OK);
      $this->json('POST', 'api/ip_lists', $this->ipData2, ['Accept' => 'application/json']);
      $this->json('POST', 'api/ip_lists', $this->ipData3, ['Accept' => 'application/json']);

        $response=$this->json('GET', "api/log_histories", ['Accept' => 'application/json']);
        $response->assertStatus(Response::HTTP_OK);
        $response_data=$response->json();
        $this->assertCount(3,$response_data['data']);

        //dd($response);
    }
}

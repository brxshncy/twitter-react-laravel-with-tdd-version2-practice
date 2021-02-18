<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTestController extends TestCase
{

   use withFaker;
   public function test_user_can_register()

   {
       $this->withoutExceptionHandling();


       $payload = [
           'email' => $this->faker->email,
           'password' => $this->faker->password,
           'name' => $this->faker->name 
       ];

       $response = $this->postJson(route('register'), $payload);
       $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => ['user']
                ]);
   }

   public function test_user_can_login()
   {
       $this->withoutExceptionHandling();
       $payload = [
           'email' => 'bruce@test.com',
           'password' => 'test123'
       ];

       $response = $this->postJson(route('login') , $payload);
       $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => ['accessToken', 'user']
                ]);
   }

   public function test_user_cannot_login_if_wrong_credentials()
   {
       $this->withoutExceptionHandling();
       $payload = [
           'email' => 'bruce@testtt.com',
           'password' => 'test123'
       ];

       $response = $this->postJson(route('login'), $payload);
       $response->assertUnauthorized();
   }

}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testRegister(){

        $userData = [
            'username' => $this->faker->userName,
            'email' => $this->faker->safeEmail,
            'password' => 'password', 
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201)
                ->assertJsonStructure([
                    'user' => ['id', 'username', 'email'],
                    'token'
                ]);
    }

    public function testLogin(){

        $user = User::factory()->create([
            'password' => bcrypt('password') 
        ]);

        $loginData = [
            'username' => $user->username,
            'password' => 'password'
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'user' => ['id', 'username', 'email'],
                    'token'
                ]);
    }


    public function testCheckUser()
    {
        $user = User::factory()->create();
        $response = $this->postJson('/api/check_user', ['email' => $user->email]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'user' => ['id', 'username', 'email'],
                'token'
            ]);
    }

    public function testRegisterGoogleUser()
    {
        $userData = [
            'username' => $this->faker->userName,
            'email' => $this->faker->safeEmail,
        ];

        $response = $this->postJson('/api/register_google', $userData);

        $response->assertStatus(201)
                ->assertJsonStructure([
                    'user' => ['id', 'username', 'email'],
                    'token'
                ]);
    }
}

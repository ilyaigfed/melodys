<?php

namespace Tests\Feature;

use App\Profile;
use App\User;
use Faker\Factory;
use Faker\Generator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{

    public function testRequiresEmailAndPassword()
    {
        $this->json('POST', '/api/user/login')
            ->assertJson([
                "errors" => [
                    'email' => [
                        'Поле обязательно для заполнения.'
                    ],
                    'password' => [
                        'Поле обязательно для заполнения.'
                    ]
                ]
            ]);
    }

    public function testIncorrectEmailOrPassword()
    {
        $payload = [
            'email' => 'xxxxxxxxxxxxxx@m.ru',
            'password' => str_random(64)
        ];

        $this->json('POST', '/api/user/login', $payload)
            ->assertStatus(401);
    }

    public function testUserLoginsSuccessfully()
    {
        $password = 'qweqwe123';

        $user = factory(User::class)->create([
            'password' => $password
        ]);
        $profile = factory(Profile::class)->create([
            'user_id' => $user->id
        ]);

        $payload = [
            'email' => $user->email,
            'password' => $password
        ];

        $this->json('POST', '/api/user/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                "access_token",
                "token_type",
                "expires_in"
            ]);
    }
}

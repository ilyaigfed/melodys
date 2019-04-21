<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{

    public function testRequiresFields()
    {
        $this->json('POST', '/api/user/registration')
            ->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'email' => [
                        'Поле обязательно для заполнения.'
                    ],
                    'password' => [
                        'Поле обязательно для заполнения.'
                    ],
                    'r_password' => [
                        'Поле обязательно для заполнения.'
                    ],
                    'name' => [
                        'Поле обязательно для заполнения.'
                    ],
                    'terms' => [
                        'Правила должны быть приняты.'
                    ],
                ]
            ]);
    }

    public function testRegister()
    {
        $faker = Factory::create();

        $payload = [
            'email' => $faker->email,
            'password' => 'qweqwe123',
            'r_password' => 'qweqwe123',
            'name' => $faker->userName,
            'terms' => true
        ];

        $this->json('POST', '/api/user/registration', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                "access_token",
                "token_type",
                "expires_in"
            ]);
    }
}

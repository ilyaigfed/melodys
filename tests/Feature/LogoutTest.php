<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogout()
    {
        $user = factory(User::class)->create();

       $token = JWTAuth::fromUser($user);

        $this->get('/api/user/', ['Authorization' => 'Bearer '.$token])
            ->assertStatus(200);
    }
}

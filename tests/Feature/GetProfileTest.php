<?php

namespace Tests\Feature;

use App\Profile;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetProfileTest extends TestCase
{

    public function testGetSuccessfully()
    {
        $user = factory(User::class)->create();
        $profile = factory(Profile::class)->create([
            'user_id' => $user->id
        ]);

        $this->get('/api/user/'.$user->id.'/profile')
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'about',
                'image',
                'instagram',
                'website',
                'twitter',
                'link',
                'user_id'
            ]);
    }
}

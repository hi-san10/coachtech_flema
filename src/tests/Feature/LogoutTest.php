<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogout()
    {
        $user = User::findOrFail(User::factory()->create()->id);
        $response = $this->get('/');
        $response = $this->actingAs($user);
        $response->assertAuthenticatedAs($user);
        $response = $this->post('/logout');
        $response->assertStatus(302);
        $this->assertGuest();
    }
}

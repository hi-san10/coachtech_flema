<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\Condition;
use App\Models\ShippingAddress;
use App\Models\Profile;

class ItemAllTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testItemAll()
    {
        User::factory(3)->create();
        Profile::factory(3)->create([
            'user_id' => rand(1, 3),
            'name' => $this->faker->name(),
            'post_code' => $this->faker->postcode(),
            'address' => $this->faker->streetAddress(),
            'image' => $this->faker->imageUrl()
        ]);
        ShippingAddress::factory(3)->create([
            'profile_id' => rand(1, 3),
            'post_code' => $this->faker->postcode(),
            'address' => $this->faker->streetAddress(),
        ]);
        Condition::factory(4)->create([
            'condition' => $this->faker->sentence(8)
        ]);
        $item = Item::factory(10)->create();
        $response = $this->get('/');
        $item->count() == 10;

        $response->assertStatus(200);
    }
}

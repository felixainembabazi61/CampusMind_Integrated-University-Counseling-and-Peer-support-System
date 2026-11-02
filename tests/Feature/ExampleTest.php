<?php

namespace Tests\Feature;

use App\Models\Slot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_book_an_available_slot(): void
    {
        Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'counselor', 'guard_name' => 'web']);

        $counselor = User::factory()->create();
        $counselor->assignRole('counselor');

        $user = User::factory()->create();
        $user->assignRole('user');

        $slot = Slot::create([
            'counselor_id' => $counselor->id,
            'start_time' => now()->addDay()->setTime(9, 0),
            'end_time' => now()->addDay()->setTime(10, 0),
            'status' => 'available',
        ]);

        $this->actingAs($user)
            ->post('/campusmind/book-slot', ['slot_id' => $slot->id])
            ->assertRedirect();

        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'slot_id' => $slot->id,
            'status' => 'confirmed',
        ]);

        $this->assertDatabaseHas('slots', [
            'id' => $slot->id,
            'status' => 'booked',
        ]);
    }

    public function test_user_is_redirected_to_home_after_login(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/');
    }
}

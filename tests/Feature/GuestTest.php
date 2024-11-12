<?php

namespace Tests\Feature;

use App\Models\Guest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestsIndex(): void
    {
        $response = $this->get('/api/v1/guests');

        $response->assertStatus(200);
    }

    public function testGuestsShow()
    {
        $guest = Guest::factory()->create([
            'first_name' => "Sayan",
            'last_name' => "Shtolts",
            'phone_number' => '+79295558899',
            'email' => 'juice@mail.ru'
        ]);

        $response = $this->get("/api/v1/guests/{$guest->id}");

        $response->assertStatus(200);

        $response->assertJsonPath('selected_guest.first_name', $guest->name);
    }

    public function testGuestsStore()
    {
        $response = $this->post('/api/v1/guests/', [
            'id' => 22,
            'first_name' => "Boris",
            'last_name' => "Dugarov",
            'phone_number' => '+79295556620',
            'email' => 'duga@mail.ru'
        ]);

        $response->assertJsonPath('created_guest.name', 'Boris');

        $this->assertDatabaseCount('guests', 11);

        $this->assertDatabaseHas('guests', [
            'first_name' => 'Boris'
        ]);
    }


}

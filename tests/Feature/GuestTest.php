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


}

<?php

namespace Tests\Feature\raffle;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class raffleTest extends TestCase
{
    const RAFFLE_KEYS = ['id', 'email', 'winner', 'alert'];
    /**
     * Test para comprobar funcionalidad del sorteo.
     */
    public function test_a_raffle(): void
    {
        $response = $this->get(route('landingPage.generate_raffle'));
        $response_data = $response->json();
        if (isset($response_data['email'])) {
            foreach (self::RAFFLE_KEYS as  $key) {
                $this->assertArrayHasKey($key, $response_data);
            }
            $response->assertStatus(200);
        }
        $this->assertArrayHasKey('alert', $response_data);
    }
}

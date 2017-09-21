<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SessionTest extends TestCase
{
    /**
     * Test the Session Store Endpoint.
     *
     * @return void
     */
    public function testStore()
    {
        $response = $this->json('POST', 'api/v1/sessions', [], ['content-type' => env('CONTENT_TYPE')]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => ['type' => 'sessions'],
            ])
            ->assertHeader("Authorization");
    }
}

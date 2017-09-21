<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageTest extends TestCase
{
    protected $authHeader;
    protected $noAuthHeader;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $session = $this->json('POST', 'api/v1/sessions', [], ['content-type' => env('CONTENT_TYPE')]);
        $token = $session->headers->get('Authorization');

        $this->authHeader = [
            'content-type' => env('CONTENT_TYPE'),
            'Authorization' => $token
        ];
        $this->noAuthHeader = [
            'content-type' => env('CONTENT_TYPE'),
        ];
    }

    /**
     * Test the Message Index Endpoint.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->assertTrue(true);
    }

    /**
     * Test the Message Store Endpoint.
     *
     * @return void
     */
    public function testStore()
    {
        $response = $this->json('POST', 'api/v1/messages', [], $this->noAuthHeader);
        $response->assertStatus(403);

        $response = $this->json('POST', 'api/v1/messages', [], $this->authHeader);
        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => ['type' => 'messages'],
            ])
            ->assertHeader("Authorization");
    }

}

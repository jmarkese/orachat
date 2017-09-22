<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageTest extends TestCase
{
    protected $user;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $this->user = User::create(['username'=>'user1234']);
    }

    /**
     * Test the Message Index Endpoint.
     *
     * @return void
     */
    public function testIndex()
    {
        // Test unauthenticated user
        $response = $this->json('GET', 'api/v1/messages', [], $this->createHeader(false));
        $response->assertStatus(401);

        // Test authenticated user
        $response = $this->json('GET', 'api/v1/messages', [], $this->createHeader());
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [['type' => 'messages']],
            ])
            ->assertJson([
                'links' => ['first' => true, 'last' => true, 'prev' => null, 'next' => true],
            ])
            ->assertHeader("Authorization");
    }

    /**
     * Test the Message Store Endpoint.
     *
     * @return void
     */
    public function testStore()
    {
        // Test unauthenticated user
        $response = $this->json('POST', 'api/v1/messages', [], $this->createHeader(false));
        $response->assertStatus(401);

        // Test validation
        $response = $this->json('POST', 'api/v1/messages', [], $this->createHeader(true));
        $response->assertStatus(422);

        // Test authenticated user
        $response = $this->json('POST', 'api/v1/messages', ['message' => 'test message'], $this->createHeader());
        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => ['type' => 'messages'],
            ])
            ->assertHeader("Authorization");
    }

    /**
     * Generate request headers
     *
     * @return String
     */
    public function createHeader($auth = true)
    {
        $headers['content-type'] = env('CONTENT_TYPE');

        if($auth){
            $headers['Authorization'] = 'Bearer ' . \Tymon\JWTAuth\Facades\JWTAuth::fromUser($this->user);
        }

        // Strange auth bug, we need to reboot the appilication
        // SEE: https://laracasts.com/discuss/channels/testing/laravel-testig-request-setting-header
        $this->refreshApplication();
        $this->setUp();

        return $headers;
    }

}

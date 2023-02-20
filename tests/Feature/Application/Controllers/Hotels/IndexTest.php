<?php

namespace Tests\Feature\Application\Controllers\Hotels;

use App\Models\Hotels\Hotel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /** @test */
    public function guest_can_index()
    {
        $this->prepare();

        $response = $this->makeRequest();

        $this->assertResponse($response);
    }

    /**
     * Make request.
     */
    protected function makeRequest(array $data = []): TestResponse
    {
        return $this->json('GET', '/api/hotels?'.Arr::query($data));
    }

    /**
     * Assert response with a snapshot.
     */
    private function assertResponse(TestResponse $response, int $status = 200): void
    {
        $response->assertStatus($status);

        if (in_array($status, [200, 201, 422])) {
            $this->assertJsonStructureSnapshot($response);
        }
    }

    public function prepare()
    {
        $hotels = Hotel::factory()->count(10)->create();

        return [$hotels];
    }
}

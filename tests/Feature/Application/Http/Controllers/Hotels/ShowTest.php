<?php

namespace Tests\Feature\Application\Http\Controllers\Hotels;

use App\Models\Hotels\Hotel;
use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ShowTest extends TestCase
{
    /** @test */
    public function guest_can_show()
    {
        [$hotel] = $this->prepare();

        $response = $this->makeRequest($hotel);

        $this->assertResponse($response);
    }

    /**
     * Make request.
     */
    protected function makeRequest(Hotel $hotel, array $data = []): TestResponse
    {
        return $this->json('GET', "/api/hotels/{$hotel->getKey()}?".Arr::query($data));
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
        $hotel = Hotel::factory()->create();

        return [$hotel];
    }
}

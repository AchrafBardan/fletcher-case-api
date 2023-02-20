<?php

namespace Tests\Feature\Application\Http\Controllers\Hotels;

use App\Models\Hotels\Hotel;
use App\Models\User;
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

    /** @test */
    public function guest_can_index_with_users()
    {
        [[$hotel]] = $this->prepare();

        $hotel->users()->sync(User::factory()->create());

        $response = $this->makeRequest([
            'include' => 'users',
        ]);

        $this->assertResponse($response);
    }

    /** @test */
    public function guest_can_index_with_text_search()
    {
        $this->prepare();

        Hotel::factory()->create([
            'name' => 'Het hotel der hotels',
        ]);

        $response = $this->makeRequest([
            'search' => 'Het hotel der hotels',
        ]);

        $this->assertCount(1, $response->json('data'));

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

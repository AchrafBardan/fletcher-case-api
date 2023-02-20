<?php

namespace Tests\Feature\Application\Http\Controllers\Hotels;

use App\Models\Hotels\Hotel;
use App\Models\Hotels\HotelUser;
use App\Models\User;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    /** @test */
    public function user_can_update()
    {
        [$user, $hotel] = $this->prepare();

        $response = $this->makeRequest($user, $hotel, [
            'name' => $newName = 'New name',
        ]);

        $this->assertResponse($response, 201);

        $this->assertDatabaseHas('hotels', [
            'id' => $hotel->getKey(),
            'name' => $newName,
        ]);
    }

    /**
     * Make request.
     */
    protected function makeRequest(User $user, Hotel $hotel, array $data = []): TestResponse
    {
        return $this->actingAs($user)
            ->json('PUT', "/api/hotels/{$hotel->getKey()}", $data);
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
        $hotelUser = HotelUser::factory()->create();

        return [$hotelUser->user, $hotelUser->hotel];
    }
}

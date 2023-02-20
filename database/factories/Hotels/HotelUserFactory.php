<?php

namespace Database\Factories\Hotels;

use App\Models\Hotels\Hotel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotels\HotelUser>
 */
class HotelUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'hotel_id' => Hotel::factory(),
            'user_id' => User::factory(),
        ];
    }
}

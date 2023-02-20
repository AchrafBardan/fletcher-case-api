<?php

namespace App\Library\Actions\Hotels;

use App\Models\Hotels\Hotel;

class UpdateHotel {
    public function __invoke(Hotel $hotel, array $data): Hotel
    {
        $hotel->update($data);

        return $hotel;
    }
}

<?php

namespace App\Library\Actions\Hotels;

use App\Models\Hotels\Hotel;
use Illuminate\Support\Arr;

class UpdateHotel {
    public function __invoke(Hotel $hotel, array $data): Hotel
    {
        $hotel->update($data);

        if(Arr::has($data, 'users.sync')) {
            $hotel->users()->sync(Arr::get($data, 'users.sync'), false);
        }

        return $hotel;
    }
}

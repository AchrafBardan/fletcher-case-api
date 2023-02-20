<?php

use App\Http\Resources\Hotels\HotelResource;
use App\Models\Hotels\Hotel;

return [
    /**
     * Configure resources that do not follow the default auto discovery rules.
     */
    'resource_factory' => [
        Hotel::class => HotelResource::class,
    ],

];

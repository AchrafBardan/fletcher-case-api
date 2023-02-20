<?php

namespace App\Http\Controllers\Hotels;

use App\Http\Controllers\Controller;
use App\Library\Actions\Hotels\BuildIndexQuery;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = (new BuildIndexQuery())()->paginate();

        return response()->json(resource($hotels));
    }
}

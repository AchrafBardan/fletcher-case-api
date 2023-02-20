<?php

namespace App\Http\Controllers\Hotels;

use App\Http\Controllers\Controller;
use App\Library\Actions\Hotels\BuildIndexQuery;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $hotels = (new BuildIndexQuery())(search: $request->get('search'))->paginate();

        return response()->json(resource($hotels));
    }
}

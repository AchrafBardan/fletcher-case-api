<?php

namespace App\Http\Controllers\Hotels;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hotels\UpdateRequest;
use App\Library\Actions\Hotels\BuildIndexQuery;
use App\Library\Actions\Hotels\BuildShowQuery;
use App\Library\Actions\Hotels\UpdateHotel;
use App\Models\Hotels\Hotel;
use Illuminate\Http\Request;

/**
 * @group Hotels
 */
class HotelController extends Controller
{
    public function index(Request $request)
    {
        $hotels = (new BuildIndexQuery())(search: $request->get('search'))->paginate();

        return response()->json(resource($hotels));
    }

    public function show(int $id)
    {
        $hotel = (new BuildShowQuery())(Hotel::whereId($id))->first();

        return response()->json(resource($hotel));
    }

    public function update(Hotel $hotel, UpdateRequest $request)
    {
        $hotel = (new UpdateHotel())($hotel, $request->validated());

        return response()->json(resource($hotel), 201);
    }
}

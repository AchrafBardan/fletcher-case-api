<?php

namespace App\Library\Actions\Hotels;

use App\Models\Hotels\Hotel;
use Illuminate\Support\Collection;
use League\Csv\Reader;
use League\Csv\Statement;

class ImportHotelsFromCsv {
    /**
     * @param string $path The path to the CSV file
     */
    public function __invoke(string $path): Collection
    {
        $csv = Reader::createFromPath($path, 'r');
        $statement = Statement::create();
        $records = $statement->process($csv);

        $hotels = collect($records);

        return $hotels->map(function ($hotel) {
            return Hotel::create([
                'internal_id' => $hotel[0],
                'name' => $hotel[1],
                'zip' => $hotel[2],
                'address' => $hotel[3],
                'city' => $hotel[4],
                'state' => $hotel[5],
                'country' => 'NL',
                'phone_number' => $hotel[6],
                'email' => $hotel[7],
            ]);
        });
    }
}

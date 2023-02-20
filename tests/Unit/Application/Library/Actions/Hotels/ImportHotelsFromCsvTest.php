<?php

namespace Tests\Unit\Application\Library\Actions\Hotels;

use App\Library\Actions\Hotels\ImportHotelsFromCsv;
use App\Models\Hotels\Hotel;
use Tests\TestCase;

class ImportHotelsFromCsvTest extends TestCase
{
    /** @test */
    public function it_can_import()
    {
        $hotels = (new ImportHotelsFromCsv)(base_path('tests/Support/Hotels/hotels.csv'));

        $this->assertInstanceOf(Hotel::class, $hotels->first());

        $this->assertDatabaseCount('hotels', 3);
    }
}

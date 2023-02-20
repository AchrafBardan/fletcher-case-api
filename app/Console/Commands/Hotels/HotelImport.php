<?php

namespace App\Console\Commands\Hotels;

use App\Library\Actions\Hotels\ImportHotelsFromCsv;
use Illuminate\Console\Command;
use function Termwind\render;

class HotelImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotel:import {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import hotels from CSV file.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error('File not found.');
            return Command::FAILURE;
        }

        $hotels = (new ImportHotelsFromCsv())($file);

        render(<<<HTML
            <div class="mx-2 my-1">
                <div class="space-x-1">
                    <span class="px-1 bg-green-500 text-white">Succesfully imported {$hotels->count()} hotels</span>
                </div>
            </div>
        HTML);

        return Command::SUCCESS;
    }
}

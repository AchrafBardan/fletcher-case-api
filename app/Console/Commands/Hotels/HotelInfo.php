<?php

namespace App\Console\Commands\Hotels;

use App\Models\Hotels\Hotel;
use Illuminate\Console\Command;
use function Termwind\{render};

class HotelInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotel:info {hotel}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches hotel info';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $hotel = Hotel::where('name','LIKE','%'.$this->argument('hotel').'%')->first();

        if(!$hotel){
            $this->error('Hotel not found');
            return Command::FAILURE;
        }

        $this->renderHotelInfo($hotel);

        return Command::SUCCESS;
    }

    public function renderHotelInfo(Hotel $hotel): void
    {
        render(<<<HTML
            <div class="mx-2 my-1">
                <div class="space-x-1">
                    <span class="px-1 bg-blue-500 text-white">Hotel info</span>
                </div>

                <div class="mt-1">
                    <div class="flex space-x-1">
                        <span class="font-bold">Name:</span>
                        <span class="font-bold text-green">$hotel->name</span>
                    </div>

                    <div class="flex space-x-1">
                        <span class="font-bold">Internal id:</span>
                        <span class="font-bold text-green">$hotel->internal_id</span>
                    </div>
                    <br/>
                    <div class="space-x-1">
                        <span class="px-1 bg-blue-100 text-white">Address</span>
                    </div>

                    <div class="flex space-x-1 text-green">
                        <span class="font-bold">$hotel->address</span>
                    </div>
                    <div class="flex space-x-1 text-green">
                        <span class="font-bold">$hotel->city</span>
                        <span class="font-bold">$hotel->zip_code</span>
                    </div>

                    <br/>
                    <div class="space-x-1">
                        <span class="px-1 bg-blue-100 text-white">Contact</span>
                    </div>

                    <div class="flex space-x-1">
                        <span class="font-bold">Phone number:</span>
                        <span class="font-bold text-green">$hotel->phone_number</span>
                    </div>
                    <div class="flex space-x-1">
                        <span class="font-bold">Email:</span>
                        <span class="font-bold text-green">$hotel->email</span>
                    </div>
                </div>
            </div>
        HTML);
    }
}

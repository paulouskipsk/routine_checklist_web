<?php

namespace Database\Seeders;

use App\Services\DistrictService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DistrictsSeeder extends Seeder {

    public function run(): void {
        $districtService = App::make(DistrictService::class);
        $districtService->syncAllCitiesAndStates();
    }
}

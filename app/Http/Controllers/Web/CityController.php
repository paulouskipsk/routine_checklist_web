<?php

namespace App\Http\Controllers\Web;

use App\Enums\Status;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends ControllerWeb {
   
    public function getCitiesByName(Request $request) {
        $cities = City::with('state')
                      ->whereStatus(Status::ACTIVE)
                      ->where('name', 'ilike', "%$request->search%")
                      ->limit(20)
                      ->get();
        return json_encode($cities);
    }

}

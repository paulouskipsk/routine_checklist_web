<?php

namespace App\Services;

use App\Models\City;
use App\Models\State;
use App\Utils\Functions;
use Illuminate\Support\Facades\Http;

class DistrictService {

    public function syncAllCitiesAndStates(){
        $response = Http::accept('application/json')->get('http://servicodados.ibge.gov.br/api/v1/localidades/distritos');
        $districts = json_decode($response->body());

        $ufs = State::all();
        $states = [];
        if(!Functions::nullOrEmpty($ufs)) {
            foreach ($ufs as $state) {
                $states[$state->acronym] = $state;
            }
        }            

        foreach ($districts as $district) {
            $state = $district->municipio->microrregiao->mesorregiao->UF;
            if(Functions::nullOrEmpty($states) || !isset($states[$state->sigla]) ){
                $state = $this->insertState($state);
                $states[$state->acronym] = $state;
            }else{
                $state = $states[$state->sigla];
            }

            $cityCode = $district->municipio->id;
            $cityName = $district->municipio->nome;
            City::updateOrCreate(
                ['code' => $cityCode],
                ['code' => $cityCode, 'name' => $cityName, 'stat_id' => $state->id, 'status' => 'A']
            );
        }
    }

    private function insertState($state){
        $state = State::updateOrCreate(
            ['acronym' => $state->sigla],
            ['code' => $state->id, 'name' => $state->nome, 'acronym' => $state->sigla, 'status' => 'A']
        );
        return $state;
    }

}
<?php
namespace App\Lib;

use App\Models\State;
use App\Models\City;

class StateHelper 
{
    public static function getStates($columns = ['*']) : array
    {
        try{
            $states = State::get($columns)->toArray();
            return $states;
        } catch (\Exception $error) {
            throw new \Exception ($error->getMessage());
        }
    }

    public static function getCitiesByStateCode($state_code = null, $columns = ['*']) : array
    {
        try{
            $cities = City::where('state_code', $state_code)->get($columns)->toArray();
            return $cities;
        } catch (\Exception $error) {
            throw new \Exception ($error->getMessage());
        }
    }
}
<?php
namespace App\Lib;
use App\Models\User;
use App\Models\OxygenCylinder;
use App\Models\Booking;
use DB;

class ConsumerHelper
{
    public static function getSupplier($columns = ['*']) : array
    {
        try {
            $supplierData = User::leftJoin('oxygen_cylinders', 'users.id', '=', 'oxygen_cylinders.user_id')
            ->leftJoin('states', 'users.state_id', '=', 'states.id')
            ->leftJoin('cities', 'users.city_id', '=', 'cities.id')
            ->orderBy('state_id')
            ->get($columns)
            ->toArray();

            return $supplierData;
        } catch (\Exception $error) {
            throw new \Exception ($error->getMessage());
        }
    }

    public static function getSupplierByStateId($state_id = null,$columns = ['*']) : array
    {
        try {
            $supplierData = User::where('state_id', $state_id)
            ->get($columns)
            ->toArray();

            return $supplierData;
        } catch (\Exception $error) {
            throw new \Exception ($error->getMessage());
        }
    }

    public static function getCylinderBySupplier($supplier_id = null,$columns = ['*']) : array
    {
        try {
            $cylinderData = OxygenCylinder::where('user_id', $supplier_id)->first($columns)->toArray();
            
            if($cylinderData['5_ltr_qty'] < 1) {
                unset($cylinderDatap['5_ltr_qty']);
            }
            if($cylinderData['10_ltr_qty'] < 1) {
                unset($cylinderDatap['10_ltr_qty']);
            }
            if($cylinderData['15_ltr_qty'] < 1) {
                unset($cylinderDatap['15_ltr_qty']);
            }

            return $cylinderData;
        } catch (\Exception $error) {
            throw new \Exception ($error->getMessage());
        }
    }
}
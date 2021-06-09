<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lib\ConsumerHelper;

class ConsumerController extends Controller
{
    public function index()
    {
        try {
            
            // $suppliersData = ConsumerHelper::getSupplier();
            $suppliersData = ConsumerHelper::getSupplier(['users.id','users.name','users.email','users.phone','oxygen_cylinders.5_ltr_qty','oxygen_cylinders.10_ltr_qty','oxygen_cylinders.15_ltr_qty','states.name as state','cities.city_name']);

            return view('consumer.home', compact('suppliersData'));

        } catch (\Exception $error) {
            \Log::error($error->getFile() . ' ~ ' . $error->getMessage() . ' ~ ' . $error->getLine());
            return view('error');
        }
    }
}

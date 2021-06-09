<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookingRequest;
use App\Lib\StateHelper;
use App\Lib\ConsumerHelper;
use App\Lib\BookingHelper;
use Auth;

class BookingController extends Controller
{
    public function index()
    {
        try {

            $user_id = Auth::user()->id;

            $bookings =  BookingHelper::getBookingsBySupplierId($user_id, ['bookings.id','bookings.name','bookings.gender','bookings.age','bookings.addar_number','bookings.id_proof','bookings.is_covid_positve','bookings.covid_positive_date','bookings.address','bookings.phone','bookings.cylinder_type','bookings.status','states.name as state','cities.city_name']);

            // dd($bookings);

            return view('supplier.dashboard', compact('bookings'));

        } catch (\Exception $error) {
            \Log::error($error->getFile() . ' ~ ' . $error->getMessage() . ' ~ ' . $error->getLine());
            return view('error');
        }
    }

    public function bookCylinder()
    {
        try {

            $states = StateHelper::getStates(['id', 'name', 'code']);

            return view('consumer.bookCylinder', compact('states'));

        } catch (\Exception $error) {
            \Log::error($error->getFile() . ' ~ ' . $error->getMessage() . ' ~ ' . $error->getLine());
            return view('error');
        }
    }

    public function getSupplierByState(Request $request) : object
    {
        try {

            $suppliers = ConsumerHelper::getSupplierByStateId($request->state_id, ['id', 'name']);
            return response()->json(['success'=>true, 'response'=>$suppliers]);

        } catch (\Exception $error) {
            \Log::error($error->getFile() . ' ~ ' . $error->getMessage() . ' ~ ' . $error->getLine());
            return response()->json(['success'=>false, 'error'=>$error->getMessage()]);
        }
    }

    public function getCylinderBySupplier(Request $request) : object
    {
        try {

            $suppliers = ConsumerHelper::getCylinderBySupplier($request->supplier_id, ['5_ltr_qty', '10_ltr_qty', '15_ltr_qty']);
            return response()->json(['success'=>true, 'response'=>$suppliers]);

        } catch (\Exception $error) {
            \Log::error($error->getFile() . ' ~ ' . $error->getMessage() . ' ~ ' . $error->getLine());
            return response()->json(['success'=>false, 'error'=>$error->getMessage()]);
        }
    }

    public function store(StoreBookingRequest $request)
    {
        try {

            $res = BookingHelper::createBooking($request);

            return redirect('/')->with('status', 'Your Request Created Successfully!');

        } catch (\Exception $error) {
            \Log::error($error->getFile() . ' ~ ' . $error->getMessage() . ' ~ ' . $error->getLine());
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    public function updateBookingStatus($booking_id, Request $request)
    {

        try {

            $updateData = [
                'status' => $request->booking_status
            ];

            $suppliers = BookingHelper::updateBooking($request->booking_id, $updateData);

            if($suppliers === true) {
                return response()->json(['success'=>true, 'response'=>$suppliers]);
            } else {
                throw new \Exception ('Booking status not update');
            }

        } catch (\Exception $error) {
            \Log::error($error->getFile() . ' ~ ' . $error->getMessage() . ' ~ ' . $error->getLine());
            return response()->json(['success'=>false, 'error'=>$error->getMessage()]);
        }
    }
}

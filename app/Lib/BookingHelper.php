<?php
namespace App\Lib;
use App\Models\Booking;
use DB;
use Carbon\Carbon;

class BookingHelper
{

    public static function getBookingsBySupplierId($supplier_id = null, $columns = ['*']) : array
    {
        try {

            $booking = Booking::where('user_id', '=', $supplier_id)
            ->leftJoin('states', 'states.id','=', 'bookings.state_id')
            ->leftJoin('cities', 'cities.id','=', 'bookings.city_id')
            ->orderby('bookings.created_at')
            ->get($columns)
            ->toArray();

            return $booking;

        } catch (\Exception $error) {
            throw new \Exception ($error->getMessage());
        }
    }

    public static function createBooking($request) : object
    {
        try {

            DB::beginTransaction();

            $date = Carbon::now();

            $idImage = $request->file('consumer_idproof');
            $imageName = 'id_image_'.md5($date->toDateTimeString()).'.'.$idImage->getClientOriginalExtension();
            $idImage->move(storage_path('app/public/images/consumer'), $imageName);
            
            $booking = Booking::create([
                'user_id' => $request->supplier_id,
                'name' => $request->consumer_name,
                'gender' => $request->consumer_gender,
                'age' => $request->consumer_age,
                'addar_number' => $request->consumer_aadhar_num,
                'id_proof' => 'storage/images/consumer/'.$imageName,
                'is_covid_positve' => $request->is_covid_poritive,
                'covid_positive_date' => date("Y-m-d", strtotime($request->covid_positive_date)),
                'address' => $request->consumer_address,
                'state_id' => $request->consumer_state,
                'city_id' => $request->consumer_city,
                'phone' => $request->consumer_phone_num,
                'cylinder_type' => $request->book_oxygen_cylinder
            ]);

            DB::commit();

        return $booking;

        } catch (\Exception $error) {
            DB::rollback();
            throw new \Exception ($error->getMessage());
        }
    }

    public static function updateBooking($booking_id, $updateData) : bool
    {
        try {

            DB::beginTransaction();
            
            $booking = Booking::find($booking_id);

            foreach($updateData as $key=>$data) {
                $booking->$key = $data;
            }

            $status = $booking->save();

            DB::commit();

            return $status;

        } catch (\Exception $error) {
            DB::rollback();
            throw new \Exception ($error->getMessage());
        }
    }
}
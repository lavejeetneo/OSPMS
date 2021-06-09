<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Requests\StorUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Lib\StateHelper;
use App\Models\OxygenCylinder;
use DB;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $states = StateHelper::getStates(['id', 'name', 'code']);
        return view('auth.register2', compact('states'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StorUserRequest $request)
    {

        try {
            DB::beginTransaction();

            $date = Carbon::now();

            $idImage = $request->file('idproof');
            $imageName = 'id_image_'.md5($date->toDateTimeString()).'.'.$idImage->getClientOriginalExtension();
            $idImage->move(storage_path('app/public/images/supplier'), $imageName);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'age' => $request->age,
                'addar_number' => $request->aadhar_num,
                'id_proof' => 'storage/images/supplier/'.$imageName,
                'address' => $request->address,
                'state_id' => $request->state,
                'city_id' => $request->supplier_city,
                'phone' => $request->phone_num,
                'password' => Hash::make($request->password),
            ]);

            if($user) {
                $assignCyliner = OxygenCylinder::firstOrCreate([
                    'user_id' => $user->id
                ]);
            }

            DB::commit();

        } catch (\Exception $error) {
            DB::rollback();
            throw new \Exception($error->getMessage());
        }

        event(new Registered($user));

        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        return redirect()->route('dashboard');
    }

    public function getCitiesByState(Request $request) : object
    {
        try {
            $cities = StateHelper::getCitiesByStateCode($request->state_code);
            return response()->json(['success'=>true, 'response'=>$cities]);
        } catch (\Exception $error) {
            \Log::error($error->getFile() . ' ~ ' . $error->getMessage() . ' ~ ' . $error->getLine());
            return response()->json(['success'=>false, 'error'=>$error->getMessage()]);
        }
    }
}

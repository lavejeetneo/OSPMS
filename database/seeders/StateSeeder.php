<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;
use DB;

class StateSeeder extends Seeder
{
    protected $states;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $statesData = json_decode($this->getStates());

            DB::beginTransaction();

            foreach($statesData as $state) {
                $stateModel = State::firstOrCreate([
                    'code'=>$state->code,
                    'name'=>$state->name
                ]);
                $stateModel->save();
            }

            DB::commit();

        } catch (\Exception $error) {
            DB::rollback();
            throw new Exception($error->getMessage());
        }
    }

    public function setStates()
    {
        $this->states = '[{"code": "AN","name": "Andaman and Nicobar Islands"},{"code": "AP","name": "Andhra Pradesh"},{"code": "AR","name": "Arunachal Pradesh"},{"code": "AS","name": "Assam"},{"code": "BR","name": "Bihar"},{"code": "CG","name": "Chandigarh"},{"code": "CH","name": "Chhattisgarh"},{"code": "DH","name": "Dadra and Nagar Haveli"},{"code": "DD","name": "Daman and Diu"},{"code": "DL","name": "Delhi"},{"code": "GA","name": "Goa"},{"code": "GJ","name": "Gujarat"},{"code": "HR","name": "Haryana"},{"code": "HP","name": "Himachal Pradesh"},{"code": "JK","name": "Jammu and Kashmir"},{"code": "JH","name": "Jharkhand"},{"code": "KA","name": "Karnataka"},{"code": "KL","name": "Kerala"},{"code": "LD","name": "Lakshadweep"},{"code": "MP","name": "Madhya Pradesh"},{"code": "MH","name": "Maharashtra"},{"code": "MN","name": "Manipur"},{"code": "ML","name": "Meghalaya"},{"code": "MZ","name": "Mizoram"},{"code": "NL","name": "Nagaland"},{"code": "OR","name": "Odisha"},{"code": "PY","name": "Puducherry"},{"code": "PB","name": "Punjab"},{"code": "RJ","name": "Rajasthan"},{"code": "SK","name": "Sikkim"},{"code": "TN","name": "Tamil Nadu"},{"code": "TS","name": "Telangana"},{"code": "TR","name": "Tripura"},{"code": "UK","name": "Uttarakhand"},{"code": "UP","name": "Uttar Pradesh"},{"code": "WB","name": "West Bengal"}]';
    }

    public function getStates()
    {
        $this->setStates();
        return $this->states;
    }
}

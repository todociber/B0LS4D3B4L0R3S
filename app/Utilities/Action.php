<?php


namespace App\Utilities;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class Action
{

    public function makePassword($data)
    {

        $date = Carbon::now();

        $hash = Hash::make($date->timestamp . $data);
        $pass = str_limit($hash, 5);

        $hash = Hash::make($date->timestamp.$data);//Hash::make($date->timestamp.$data);
        $pass = str_limit($hash,5);


        return '12345';

    }


}
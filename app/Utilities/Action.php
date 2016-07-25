<?php


namespace App\Utilities;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class Action
{

    public function makePassword($data){

        $date = Carbon::now();
        $hash = Hash::make($date->timestamp.$data);
        $pass = str_limit($hash,5);

        return $pass;

    }
    
}
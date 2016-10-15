<?php


namespace App\Utilities;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

    public function sendEmail($data, $email, $tema, $subject, $page)
    {
        Mail::send($page, $data, function ($message) use ($email, $tema, $subject) {

            $message->from('sandbox34d44e5a00664adb81a8297905b05f4e.mailgun.org', $tema);

            $message->to($email)->subject($subject);

        });
        
        
    }


}
<?php


namespace App\Utilities;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Snowfire\Beautymail\Beautymail;

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
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send($page, $data, function ($message) use ($email, $tema, $subject) {

            $message->from('todocyber100@gmail.com', $tema);

            $message->to($email)->subject($subject);

        });
        
        
    }


}
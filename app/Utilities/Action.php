<?php


namespace App\Utilities;

use App\Models\Cliente;
use App\Models\Ordene;
use Asachanfbd\LaravelPushNotification\PushNotification;
use Carbon\Carbon;
use DB;
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
        try {
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send($page, $data, function ($message) use ($email, $tema, $subject) {

            $message->from('todocyber100@gmail.com', $tema);

            $message->to($email)->subject($subject);

        });
        } catch (\Exception $e) {
            
        }


    }

    public function killSession($idUser)
    {
        DB::table("sessions")->where("user_id", $idUser)
            ->delete();
    }

    public function killAllSessionsHouse($users)
    {

        DB::table("sessions")->whereIn("user_id", $users)->delete();
    }

    //IDCLIENTE Y TIPO DE PUSH ENVIAR PARAMETRO ENTERO, y id de orden o afiliacion
    public function sendPush($idCliente, $tipo, $idOrden)
    {
        /*
         *
         * Orden para cuandon cambie el estado,
         * afiliaciones cuando cambié estado , mensajes y operaciones de bolsa
         *
         * */
        $cliente = Cliente::where("id", $idCliente)->first();
        if ($cliente->tokenPush) {

        $mensaje = '';
        $arrsend = [];
        if ($tipo == 1) {
            $mensaje = 'Una orden ha cambiado de estado';
            $orden = Ordene::where("id", $idOrden)->first();
            $arrsend = ["tipo" => $tipo, "mensaje" => $mensaje, "idOrden" => $orden->id, "idOrganizacion" => $orden->idOrganizacion];
        } else if ($tipo == 2) {
            $mensaje = 'Ha recibido respuesta de una afiliación';
            $arrsend = ["tipo" => $tipo, "mensaje" => $mensaje, "idOrden" => "0", "idOrganizacion" => "0"];

        } else if ($tipo == 3) {
            $mensaje = 'Ha recibido mensaje de una orden';
            $orden = Ordene::where("id", $idOrden)->first();
            $arrsend = ["tipo" => "3", "mensaje" => $mensaje, "idOrden" => $orden->id, "idOrganizacion" => $orden->idOrganizacion];
        } else if ($tipo == 4) {
            $mensaje = 'Se ha realizado una operación de bolsa a un orden';
            $orden = Ordene::where("id", $idOrden)->first();
            $arrsend = ["tipo" => $tipo, "mensaje" => $mensaje, "idOrden" => $orden->id, "idOrganizacion" => $orden->idOrganizacion];
        }

            $message = PushNotification::message("SERO", $arrsend);
            $collection = PushNotification::app('android')
            ->to($cliente->tokenPush)
                ->send($message);

            //var_dump($collection->ge);

            // get response for each device push


        }

    }

    public function checkPass($pass)
    {
        $count = strlen($pass);
        $entropia = 0;
        // Contamos cuantas mayusculas, minusculas, numeros y simbolos existen
        $upper = 0;
        $lower = 0;
        $numeros = 0;
        $otros = 0;

        for ($i = 0, $j = strlen($pass); $i < $j; $i++) {
            $c = substr($pass, $i, 1);
            if (preg_match('/^[[:upper:]]$/', $c)) {
                $upper++;
            } elseif (preg_match('/^[[:lower:]]$/', $c)) {
                $lower++;
            } elseif (preg_match('/^[[:digit:]]$/', $c)) {
                $numeros++;
            } else {
                $otros++;
            }
        }

        // Calculamos la entropia

        $entropia = ($upper * 4.7) + ($lower * 4.7) + ($numeros * 3.32) + ($otros * 6.55);
        $mensaje = "";
        /*if ($entropia<28)
        {
            $mensaje= "Password muy debil";
        }elseif($entropia<36) {
            $mensaje= "Password debil";
        }elseif($entropia<60) {
            $mensaje= "Password Razonable";
        }elseif($entropia<128) {
            $mensaje= "Password Fuerte";
        }else {
            $mensaje= "Password Muy Fuerte";
        }*/

        return $entropia;

    }



}
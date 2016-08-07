<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Models\LatchModel;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Latch;

class LatchController extends Controller
{
    public function pair(Request $request)
    {

        // Comprobamos que venga el token desde el formulario
        if (Input::has('token')) {
            // Obtenemos el código de pareado del usuario
            $token = $request['token'];
            // Intenta parear Latch con el código (token)
            if ($accountId = Latch::pair($token)) {

                $codUsuario = DB::table('latchdatatoken')
                    ->where('latchdatatoken.idUsuario', '=', Auth::user()->id)
                    ->whereNull('deleted_at')
                    ->count();

                if ($codUsuario == 0) {
                    $LatchUser = new LatchModel([
                        'idUsuario' => Auth::user()->id,
                        'tokenLatch' => $accountId,
                    ]);
                    $LatchUser->save();
                } else {

                    $usuarioExostet = LatchModel::where('idUsuario', '=', Auth::user()->id)->first();
                    $usuarioExostet->delete();

                    $LatchUser = new LatchModel([
                        'idUsuario' => Auth::user()->id,
                        'tokenLatch' => $accountId,
                    ]);
                    $LatchUser->save();
                }


                echo('Pareado Exitoso el token es ' . $accountId);
                // Si consigue parear guardamos el identificador del usuario (cifrado) de Latch en nuestra base de datos
            } // Si ocurre algún error, mostramos al usuario un mensaje de error de una forma amigable
            else {
                echo Latch::error();
            }
        } else {
            echo "no hay token";
        }
    }


    public function unpair()
    {

        $LatchTokenExiste = LatchModel::where('idUsuario', '=', Auth::user()->id)->count();

        if ($LatchTokenExiste > 0) {
            // Obtenemos el identificador del usuario de Latch de nuestra base de datos
            $accountId = LatchModel::where('idUsuario', '=', Auth::user()->id)->first();
            // Despareamos al usuario de Latch
            if (Latch::unpair($accountId->tokenLatch)) {
                $accountId->delete();
                echo "desenparejado completado ";
            } // Si hay algun error, se lo mostramos al usuario
            else {
                echo Latch::error();
            }

        } else {
            echo "token no existe para el usuario";
        }

    }
}

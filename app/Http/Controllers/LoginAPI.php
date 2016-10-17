<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Organizacion;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginAPI extends Controller
{

    public function LoginUser(Request $request)
    {

        /*{
            "email":"test@test.com",
            "password":"1234556",
            "TokenPush":"1231242342"
        }*/
        try {

            $credentials = $request->only('email', 'password');
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['ErrorCode' => '2', 'msg' => 'Datos incorecctos']);
            }

            $user = JWTAuth::toUser($token);
            if ($user->idOrganizacion == null) {
                $clientes = $user->ClienteN;
                $clientes->fill(
                    [
                        'tokenPush' => $request['TokenPush'],

                    ]
                );
                $clientes->save();
                $cedevals = $clientes->CuentaCedeval;
                $idCliente = $clientes->id;
                $casas = Organizacion::whereHas('SolicitudOrganizacion', function ($query) use ($idCliente) {
                    $query->where('idCliente', $idCliente)->where('idEstadoSolicitud', 2);
                })->select('id', 'nombre')->get();

                if (count($casas) > 0) {
                    return response()->json(['ErrorCode' => '0', 'token' => $token, 'usuario' => $user,
                        'casas' => $casas]);
                } else {
                    return response()->json(['ErrorCode' => '4', 'msg' => 'No cuenta con afiliaciones vigentes']);

                }
            } else {

                return response()->json(['ErrorCode' => '2', 'msg' => 'Datos incorecctos']);
            }

        } catch (JWTException $e) {
            return response()->json(['ErrorCode' => '3', 'msg' => 'Error en ejecución de servicio de web']);

        }
    }

}

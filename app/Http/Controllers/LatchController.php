<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Models\LatchModel;
use App\Utilities\RolIdentificador;
use Auth;
use DB;
use ErrorException;
use Illuminate\Support\Facades\Input;
use Latch;
use Mockery\CountValidator\Exception;

class LatchController extends Controller
{
    public function pair(Requests\RequestLatch $request)
    {

        // Comprobamos que venga el token desde el formulario
        if (Input::has('token')) {
            // Obtenemos el código de pareado del usuario
            $token = $request['token'];
            // Intenta parear Latch con el código (token)
            try {
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


                    return redirect('LatchSolicitud');
                    // Si consigue parear guardamos el identificador del usuario (cifrado) de Latch en nuestra base de datos
                } // Si ocurre algún error, mostramos al usuario un mensaje de error de una forma amigable
                else {
                    return redirect('LatchSolicitud')->withErrors("No puede ser pareado");
                }
            } catch (Exception $e) {
                return redirect('LatchSolicitud')->withErrors("Error de conexion con Latch");
            } catch (ErrorException $i) {
                return redirect('LatchSolicitud')->withErrors("Error de conexion con Latch");
            }

        } else {
            return redirect('LatchSolicitud')->withErrors("No puede ser pareado");
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
                flash('Desemparejado completado', 'warning');
                return redirect('LatchSolicitud');

            } // Si hay algun error, se lo mostramos al usuario
            else {
                return redirect()->back()->withErrors("No se puede realizar la accion");
            }

        } else {
            return redirect()->back()->withErrors("Error de conexion con Latch");
        }

    }

    public function LatchSolicitud()
    {


        $latch = LatchModel::where('idUsuario', '=', Auth::user()->id)->count();
        if ($latch > 0) {
            flash('Su cuenta ya se encuentra protegida por Latch', 'danger');
        } else {

        }
        $rol = new RolIdentificador();
        if ($rol->Cliente(Auth::user())) {
            return view('auth.latchCliente');
        } else if ($rol->bolsa(Auth::user())) {
            return view('auth.latchBolsa');
        } else {
            return view('auth.latch');
        }
    }
}

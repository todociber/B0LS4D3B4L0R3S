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
                    redirect()->back()->withErrors("no se encontro el token");
                }
            } catch (Exception $e) {
                redirect()->back()->withErrors("Error de conexion con Latch");
            } catch (ErrorException $i) {
                redirect()->back()->withErrors("Error de conexion con Latch");
            }

        } else {
            redirect()->back()->withErrors("no se encontro el token");
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
                echo Latch::error();
            }

        } else {
            redirect()->back()->withErrors("Error de conexion con Latch");
        }

    }

    public function LatchSolicitud()
    {

        $rolAdmin = new RolIdentificador();
        if ($rolAdmin->Administrador(Auth::user())) {
            $latch = LatchModel::where('idUsuario', '=', Auth::user()->id)->count();
            if ($latch > 0) {
                flash('Su cuenta ya se encuentra protegida por Latch', 'danger');
            } else {

            }
            return view('auth.latch');
        } else {
            return redirect()->back()->withErrors('Opcion permitida solo a administradores');
        }
    }
}

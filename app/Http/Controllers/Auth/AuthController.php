<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LatchModel;
use App\Models\Usuario;
use App\User;
use App\Utilities\RolIdentificador;
use ErrorException;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Latch;
use Mockery\CountValidator\Exception;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    // protected $redirectTo = '/UsuarioCasaCorredora';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:usuarios',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function authenticated($request, $usuario)
    {
        Log::info('TESTT');

        $rolIdentificador = new RolIdentificador();
        /*
         * 1- ADMNISTRADOR BOLSA DE VALORES
         * 2-ADMNISTRADOR CASA CORREDORA
         * 3-OPERADOR
         * 4-AGENTE CORREDOR
         * 5-CLIENTE
         * */
      //  var_dump($usuario->UsuarioRoles->RolN->id);


        $LatchTokenExiste = LatchModel::where('idUsuario', '=', Auth::user()->id)->count();

        if ($LatchTokenExiste > 0) {

            try {
                $userIDLatch = LatchModel::where('idUsuario', '=', Auth::user()->id)->first();
                $accountId = $userIDLatch->tokenLatch;
                $locked = false;

                if (Latch::locked($accountId)) {
                    $locked = true;
                }


                if ($locked) {

                    Auth::logout();
                }
            } catch (ErrorException $i) {

            } catch (Exception $e) {

            }

        }




        $userType=$usuario->UsuarioRoles[0]->RolN->id;


        if ($userType == 1) {

            return redirect()->route('catalogoUsuarios');
            //listadoCasas

        } else if ($userType == 2 || $userType == 3 || $userType == 4) {
            if ($rolIdentificador->Administrador($usuario)) {
                return redirect()->route('UsuarioCasaCorredora.index');
            } else if ($rolIdentificador->Autorizador($usuario)) {
                return redirect()->route('SolicitudAfiliacion.index');
            } else if ($rolIdentificador->AgenteCorredor($usuario)) {
                return redirect()->route('Ordenes.index');
            }


            //UsuarioCasaCorredora
        }
        else {
            //CLIENTE
            return redirect()->route('listadoordenesclienteV');


        }


        //return redirect()->route('listadoCasas'); //redirect to standard user homepage
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Usuario::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}

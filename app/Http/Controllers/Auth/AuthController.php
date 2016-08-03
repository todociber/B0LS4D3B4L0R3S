<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
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

        /*
         * 1- ADMNISTRADOR BOLSA DE VALORES
         * 2-ADMNISTRADOR CASA CORREDORA
         * 3-OPERADOR
         * 4-AGENTE CORREDOR
         * 5-CLIENTE
         * */
      //  var_dump($usuario->UsuarioRoles->RolN->id);


        $userType=$usuario->UsuarioRoles[0]->RolN->id;

        
        if ($userType == 1) {

            return redirect()->route('catalogoUsuarios');
            //listadoCasas

        } else if ($userType == 2 || $userType == 3 || $userType == 4) {
            /*SE DEBE ENVIAR A UNA PANTALLA DONDE EL ELIJA EN CUAL MODULO DESEA ENTRAR
                ESTA PANTALLA DEBE CARGAR DINAMICAMENTE LOS BOTONES SEGUN LOS PERMISO QUE TENGA.
            */

            return redirect()->route('UsuarioCasaCorredora.index');
            //UsuarioCasaCorredora
        }
        else {
            //CLIENTE

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

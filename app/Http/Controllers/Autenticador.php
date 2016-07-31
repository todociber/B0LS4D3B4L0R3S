<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class Autenticador extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    public function loginPost(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];


        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->intended('UsuarioCasaCorredora');
        } else {
            return redirect('admin')->withInput();
        }
    }


}

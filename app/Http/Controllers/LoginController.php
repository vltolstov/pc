<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public  function index(){
        return view('admin.login', [
            'title' => 'Вход'
        ]);
    }

    public function login(Request $request){

        if(Auth::check()){
            return redirect()->intended(route('admin'));
        }

        $formFields = $request->only(['email','password']);

        if(Auth::attempt($formFields, $remember = true)){
            $request->session()->regenerate();

            return redirect()->intended(route('admin'));
        }

        return redirect(route('login'))->withErrors([
            'email' => 'Ошибка входа'
        ]);

    }
}

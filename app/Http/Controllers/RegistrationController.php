<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{

    public  function index(){
        return view('admin.register', [
            'title' => 'Регистрация'
        ]);
    }

    public function save(Request $request)
    {
        if (Auth::check()) {
            return redirect(route('admin'));
        }

        $validateFields = $request->validate([
            'name' => ['required', 'string', 'max:64'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'max:16']
        ]);

        $user = User::create($validateFields);
        if ($user) {
            Auth::login($user);
            return redirect(route('admin'));
        }

        return redirect(route('register'))->withErrors('Ошибка регистрации');
    }
}

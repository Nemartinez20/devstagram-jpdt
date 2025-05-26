<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //Metodos

    // 1. El metodo index muestra la vista
    public function index()
    {
        return view('auth.register');
    }
    //2. Metodo para crear
    public function store(Request $request)
    {
        //$request->get('email) acceder a un valor
        // dd('post...', $request);

        //Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        //2.1 Validacion
        $request->validate([
            'name' => 'required|max:35',
            'username' => 'required|min:3|max:20|unique:users',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
            // 'password' => 'required',
        ]);

        // dd('post...');

        //2.2 Crear un registro
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        //2.3 Autenticar

        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        //2.4 
        Auth::attempt($request->only('email', 'password'));


        //2.5 Redireccionar al usuario si todo es OK
        return redirect()->route('posts.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\School_class;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthController extends Controller
{
    // public function storeUser()
    // {
    //     $user = User::create([
    //         'first_name' => 'Иво',
    //         'middle_name' => 'Ивелинов',
    //         'last_name' => 'Цонев',
    //         'email' => 'ivotsonev2007@gmail.com',
    //         'password' => Hash::make('Ivo123Tsonev'),
    // //123Ivo123
    //     ]);

    //     Auth::login($user);

    //     return redirect()->route("index");
    // }

    //     public function storeUser()
    // {
    //     $user = User::create([
    //         'first_name' => 'Иво',
    //         'middle_name' => 'Ивелинов',
    //         'last_name' => 'Цонев',
    //         'email' => 'ivotsonev@gmail.com',
    //         'password' => Hash::make('Ivo123Ivo'),
    // //123Ivo123
    //     ]);

    //     Auth::login($user);

    //     return redirect()->route("index");
    // }
    
    public function login()
    {
        return view('login');
    }

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Моля въведете email!',
            'email.email' => 'Моля въведете валиден email!',
            'password.required' => 'Моля въведете парола!',
        ]);

        if ($this->attemptLoginStudent($request)) {
            return redirect()->route("index");
        } elseif ($this->attemptLoginTeacher($request)) {
            $role = 'teacher';
            return redirect()->route("index", compact('role'));   
        } elseif ($this->attemptLoginAdmin($request)) {
            //$role = 12;  
            //session(['role' => $role]);
            return redirect()->route("index");
        }

        return redirect()->back()->withErrors([
            'bothError' => 'Проверете email-а и паролата отново!',
        ]);
    }

    protected function attemptLoginStudent(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && $user->id !== null) {
            if (!Student::where('user_id', $user->id)->exists() || !Hash::check($request->password, $user->password)) {
                return false;
            }

            Auth::login($user);

            return true;
        }

        return false;
    }

    protected function attemptLoginTeacher(Request $request)
    {
        $user = User::where('email', $request->email)
            ->first();

        if ($user && $user->id !== null) {
            if (!Teacher::where('user_id', $user->id)->exists() || !Hash::check($request->password, $user->password)) {
                return false;
            }

            Auth::login($user);

            return true;
        }

        return false;
    }

    protected function attemptLoginAdmin(Request $request)
    {
        $user = User::where('email', $request->email)
            ->first();

        if ($user && $user->id !== null) {
            if (!Admin::where('user_id', $user->id)->exists() || !Hash::check($request->password, $user->password)) {
                return false;
            }

            Auth::login($user);

            return true;
        }

        return false;
    }

    public function logoutF()
    {
        Auth::logout();
        return redirect('login');
    }
}
<?php

namespace App\Http\Controllers\AddUser;

use App\Http\Controllers\Controller;
use App\Imports\ImportUser;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class AddUser extends Controller
{
    public function store(Request $request)
    {
        
        $selectedRole = $request->input('user_role');
        $class = $request->input('class_id');

        $request = $request->validate([
            'first_name' =>  'required',
            'middle_name' =>  'required',
            'last_name' =>  'required',
            'user_role' => 'required',
            'email' => 'required|email|unique:users,email',
        ], [
            'first_name' =>  'Моля въведете име!',
            'middle_name' =>  'Моля въведете име!',
            'last_name' =>  'Моля въведете име!',
            'user_role' => 'Изберете роля!',
            'email.required' => 'Моля въведете email!',
            'email.email' => 'Моля въведете валиден email!',
            'email.unique' => 'Този email вече е регистриран!',
        ]);
        
        $user = User::create([
            'first_name' =>  $request['first_name'],
            'middle_name' =>  $request['middle_name'],
            'last_name' =>  $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($this->generateRandomPassword()),
        ]);

        $this->createPasswordResetTokenAndSendEmail($request['email']);

        if($selectedRole =='flexRadioStudent')
        {
            $userId = $user->id;
            Student::create([
                'user_id' =>  $userId,
                'class_id' =>   $class,
            ]);
        }
        if($selectedRole =='flexRadioTeacher')
        {
            $userId = $user->id;
            Teacher::create([
                'user_id' =>  $userId,
            ]);
        }
        if($selectedRole =='flexRadioAdmin')
        {
            $userId = $user->id;
            Admin::create([
                'user_id' =>  $userId,
            ]);
        }

        return redirect()->route("index");
    }

    public function importUsers(Request $request)
    {
        $request->validate(
            [
                'document' => 'required|mimes:doc,docx,xls,xlsx,ppt,pptx|max:8119',
            ],
            [
                'document.required' => 'Файлът е задължителен!',
                'document.mimes' => 'Моля, изберете excel файл!',
                'document.max' => 'Файлът трябва да бъде под 8 MB',
            ]
        );
    
        $file = $request->file('document');

    try {
        $result = Excel::import(new ImportUser, $file);
    } catch (ValidationException $e) {
        return redirect()->route('view.user.import')->with('message', 'В файла има невалиден/и имейл/и!');
    }

    // If import was successful, redirect to index
    return redirect()->route('index');
    }
    
    protected function createPasswordResetTokenAndSendEmail($email)
    {

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.setPassword', ['token' => $token], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Задаване на паролата');
        });
    }

    private function generateRandomPassword($length = 12)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+';
        $password = '';

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $password;
    }
}

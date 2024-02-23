<?php

namespace App\Imports;

use App\Models\School_class;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ImportUser implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function model(array $row)
    {
        try {
            $validator = validator($row, [
                0 => 'required|string|max:255',
                1 => 'required|string|max:255',
                2 => 'required|string|max:255',
                3 => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email'),
                ],
            ]);

            $validator->validate();
        } catch (ValidationException $e) {
            throw $e;
        }

        $user = User::create([
            'first_name' => $row[0],
            'middle_name' => $row[1],
            'last_name' => $row[2],
            'email' => $row[3],
            'password' => Hash::make($this->generateRandomPassword()),
        ]);

        $class = School_class::where('class', $row[4])->first();
        Student::create([
            'user_id' => $user->id,
            'class_id' => $class->id,
        ]);

        $this->createPasswordResetTokenAndSendEmail($user->email);

        return $user;
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

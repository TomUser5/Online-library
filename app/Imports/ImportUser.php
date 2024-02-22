<?php

namespace App\Imports;

use App\Models\School_class;
use App\Models\Student;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUser implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::create([
            'first_name' => $row[0],
            'middle_name' => $row[1],
            'last_name' => $row[2],
            'email' => $row[3],
            'password' => bcrypt('temporary-password'), // Hash the temporary password
        ]);

        $class = School_class::where('class', $row[4])->first();
        Student::create([
            'user_id' => $user->id,
            'class_id' => $class->id,
        ]);

        // Return the user instance
        return $user;
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

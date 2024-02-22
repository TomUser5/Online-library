<?php

namespace App\Http\Controllers\AddUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class updateUser extends Controller
{
public function updatePassword(Request $request)
{
    $userId = User::where('email', $request['email'])->first()->id;
    $user = User::findOrFail($userId);

    $request->validate([
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user->update([
        'password' =>  Hash::make($request->input('password')),
    ]);
}

}

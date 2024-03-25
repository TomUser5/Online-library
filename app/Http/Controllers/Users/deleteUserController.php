<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;

class deleteUserController extends Controller
{
    public function deleteUser($userId)
    {
        try {
            $userEmail = User::where('id', '=', $userId)->value('email');
            User::where('id', '=', $userId)
                ->delete();
            
            if (PasswordResetToken::where('email', '=', $userEmail)->exists()) {
                PasswordResetToken::where('email', '=', $userEmail)->delete();
            }


            session()->flash('success', 'Потребителят е успешно изтрит!');
            return redirect()->route('index');
        } catch (\Exception $e) {
            return "Грешка при изтриването на потребителя: " . $e->getMessage();
        }
    }
}

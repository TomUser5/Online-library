<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class deleteUserController extends Controller
{
    public function deleteUser($userId) {
        try {
            User::where('id', '=', $userId)
                ->delete();
            
                session()->flash('success', 'Потребителят е успешно изтрит!');
                return redirect()->route('index');
        } catch (\Exception $e) {
            return "Грешка при изтриването на потребителя: " . $e->getMessage();
        }
    }
}

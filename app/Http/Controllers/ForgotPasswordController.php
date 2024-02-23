<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;

class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('forgetPassword');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request)
    {
            $request->validate([
                'email' => 'required|email|exists:users,email|unique:users,email',
            ], [
                'email.required' => 'Моля въведете email!',
                'email.email' => 'Моля въведете валиден email!',
                'email.exists' => 'Този email адрес не съществува в системата.',
                'email.unique' => 'Този email адрес вече е заявен за промяна/задаване на парола.(проверете си email-а)',
            ]);
        
        

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Смяна на паролата');
        });

        return back()->with('message', 'Изпратихме Ви по email линк за смяна на паролата!');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm($token)
    {
        return view('forgetPasswordLink', ['token' => $token]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:password_reset_tokens,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ], [
            'email.required' => 'Моля въведете email!',
            'email.email' => 'Моля въведете валиден email!',
            'email.exists' => 'Този email адрес не е заявен за промяна/задаване на парола.',
            'password.required' => 'Моля въведете парола!',
            'password.string' => 'Паролата трябва да бъде символен низ.',
            'password.min' => 'Паролата трябва да бъде поне 8 символа дълга.',
            'password.confirmed' => 'Потвърдената парола не съвпада с въведената парола.',
            'password_confirmation.required' => 'Моля потвърдете паролата!',
        ]);
        

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        User::where('email', $request->email)->first()->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Redirect to the login page or any other appropriate page
        return redirect()->route('login')->with('message', 'Успешно променихте паролата!');
    }
}

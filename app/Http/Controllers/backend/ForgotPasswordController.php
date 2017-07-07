<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Reminder;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('backend.user.resetpassword');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required'
        ]);
        $user = User::whereEmail($request->email)->first();
        if (count($user) == 0) {
            return redirect()->back()->with('success_message', 'Reset link is Send to Your Email');
        }
        $reminder = Reminder::exit() ?: Reminder::create($user);
        dd($reminder);

    }

    public function broker()
    {
        return Password::broker('users');
    }


}

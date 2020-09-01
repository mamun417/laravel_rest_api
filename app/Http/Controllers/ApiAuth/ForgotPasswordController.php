<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\ApiController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected function validateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'url' => 'required' //reset password link of frontend
        ]);
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return $this->successMessage('email has been send successful', 200);
    }
}

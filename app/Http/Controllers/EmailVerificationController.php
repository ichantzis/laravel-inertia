<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function create()
    {
        return inertia('Auth/VerifyEmail');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('listing.index')
            ->with('success', 'Email was verified');
    }

    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return redirect()->back()->with('success', 'Verification link sent!');
    }
}

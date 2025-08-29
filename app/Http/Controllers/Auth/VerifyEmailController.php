<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['status' => 'already-verified']);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user())); // O modelo User deve implementar MustVerifyEmail
            return response()->json(['status' => 'email-verified']);
        }

        return response()->json(['status' => 'verification-failed'], 400);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\CommonPassword;
use Inertia\Inertia;

class PasswordController extends Controller
{
    // Show the welcome page and send the common passwords to the frontend
    public function index(): \Inertia\Response
    {
        $commonPasswords = CommonPassword::pluck('password');
        return Inertia::render('Welcome', ['commonPasswords' => $commonPasswords]);
    }
}

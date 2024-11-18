<?php

namespace App\Http\Controllers;

use App\Models\CommonPassword;
use Inertia\Inertia;

class PasswordController extends Controller
{
    public function index()
    {
        $commonPasswords = CommonPassword::pluck('password');
        return Inertia::render('Welcome', ['commonPasswords' => $commonPasswords]);
    }
}

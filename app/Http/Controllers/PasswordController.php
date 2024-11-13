<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class PasswordController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome');
    }
}

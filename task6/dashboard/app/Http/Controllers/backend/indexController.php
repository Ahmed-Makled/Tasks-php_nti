<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index()
    {
        return redirect()->route('login');
        // return  redirect()->route('auth.login');
    }

    public function dashboard()
    {
        return view('backend.dashboard');
    }
}
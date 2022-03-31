<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfirmableAccountController extends Controller
{
    public function show (Request $request)
    {
        return view('auth.confirm-account');
    }
}

<?php

namespace App\Http\Controllers\Auth\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): Renderable
    {
        return view('account.settings.security');
    }
}

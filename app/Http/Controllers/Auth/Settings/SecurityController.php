<?php

namespace App\Http\Controllers\Auth\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Settings\SecurityFormRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
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

    public function update(SecurityFormRequest $request): RedirectResponse
    {
        $request->merge(['password' => bcrypt($request->password)]);
    }
}

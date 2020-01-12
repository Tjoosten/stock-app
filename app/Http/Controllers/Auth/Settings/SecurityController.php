<?php

namespace App\Http\Controllers\Auth\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Settings\SecurityFormRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        DB::transaction(static function () use($request): void {
            $request->user()->update(['password' => Hash::make($request->password)]);
            flash('De beveiligings instellingen van je account zijn aangepast.', 'success');
        });

        return redirect()->route('account.security');
    }
}

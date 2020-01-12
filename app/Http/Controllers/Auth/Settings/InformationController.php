<?php

namespace App\Http\Controllers\Auth\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Settings\InformationFormRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class InformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): Renderable
    {
        return view('account.settings.information');
    }

    public function update(InformationFormRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $request->user()->update($request->all());
            flash('Uw account gegevens zijn aangepast', 'success');
        });

        return redirect()->route('account.information');
    }
}

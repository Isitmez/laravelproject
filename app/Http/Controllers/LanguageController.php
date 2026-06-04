<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch application locale.
     */
    public function switchLang(string $locale): RedirectResponse
    {
        if (in_array($locale, ['en', 'es', 'tr'])) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}

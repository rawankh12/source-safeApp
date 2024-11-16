<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch the application's language.
     *
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setLocale($locale)
    {
        if (in_array($locale, ['en', 'ar'])) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
        }
        return redirect()->back();
    }


}

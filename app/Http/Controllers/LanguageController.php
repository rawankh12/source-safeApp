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
    public function langChange(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('language', $request->lang);
        return back();
    }

}

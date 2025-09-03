<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    /**
     * Show 404 error page
     */
    public function notFound()
    {
        return view('errors.404');
    }

    /**
     * Show 500 error page
     */
    public function serverError()
    {
        return view('errors.500');
    }

    /**
     * Show 403 error page
     */
    public function forbidden()
    {
        return view('errors.403');
    }

    /**
     * Redirect to main page with error message
     */
    public function redirectToMain(Request $request)
    {
        $message = $request->get('message', 'Terjadi kesalahan. Anda akan diarahkan ke halaman utama.');
        
        return redirect()->route('hospitals.index')->with('error', $message);
    }
}

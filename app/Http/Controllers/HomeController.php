<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->post()) {

            if (!empty($request->post('query'))) {
            } else {
                return back()->with('error', 'Please, write the syntax!');
            }
        }
        return view('dashboard.home');
    }

    public function login()
    {
        return view('auth.login');
    }
}

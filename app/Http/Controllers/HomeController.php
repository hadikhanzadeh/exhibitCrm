<?php

namespace App\Http\Controllers;

use App\Models\tourRequest;
use Illuminate\Http\Request;
use App\Http\Lib\wbsUtility;

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
    public function index()
    {
        return view('dashboard');
    }

    public function tourRequest(Request $request)
    {
        $tourRequests = tourRequest::all()->take(10);
        return view('dashboard.pages.tour-request', ['items' => $tourRequests]);
    }
}

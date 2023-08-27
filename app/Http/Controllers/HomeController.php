<?php

namespace App\Http\Controllers;

use App\Http\Lib\crmAPI;
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

    public function generateToken(Request $request)
    {
        $token = $request->user()->createToken($request->token_name);
        return ['token' => $token->plainTextToken];

    }

    public function createToken()
    {
        return view('dashboard.pages.createToken');
    }

}

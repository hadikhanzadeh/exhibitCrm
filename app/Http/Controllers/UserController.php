<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::take(10)->get();
        return view('dashboard.pages.users.list', ['users' => $users]);
    }

    public function create()
    {
        return view('dashboard.pages.users.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|string|in:admin,operator',
        ]);

        if (!$validator->passes()) {
            return redirect()->back()->withErrors($validator);
        }
    }
}

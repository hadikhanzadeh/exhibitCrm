<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
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
            'role' => 'required|string|in:administrator,operator',
        ]);

        if (!$validator->passes()) {
            return redirect()->back()->withErrors($validator);
        }

        try {
            $user = new User;
            $user->name = $request->get('fullName');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->role = $request->get('role');

            $user->save();
            $request->session()->flash('success', __('New User Created!'));
            return redirect()->route("dashboard.users");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'User Not Created!']);
        }
    }

    public function show(Request $request)
    {
        $user = User::find($request->id);
        return view('dashboard.pages.users.view', ['user' => $user]);
    }

    public function update(Request $request)
    {

        $validateData = [
            'id' => 'required|int',
            'fullName' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|string|in:administrator,operator',
        ];

        if (!empty($request->get('password'))) {
            $validateData['password'] = 'required|confirmed|min:8';
        }

        $validator = Validator::make($request->all(), $validateData);

        if (!$validator->passes()) {
            return redirect()->back()->withErrors($validator);
        }

        $id = $request->get('id');
        $user = User::find($id);
        try {
            $user->name = $request->get('fullName');
            $user->email = $request->get('email');
            $user->role = $request->get('role');

            if (!empty($request->get('password'))) {
                $user->password = Hash::make($request->get('password'));
            }

            $user->save();
            $request->session()->flash('success', __('User Updated!'));
            return redirect()->route("dashboard.viewUser", ['id' => $id]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'User Not Updated!']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        if (\Auth::id() !== $id) {
            return redirect()->back()->withErrors(['msg' => 'You Cannot Delete This User!']);
        }
        $item = User::find($id);
        $user = new User();
        if (!$item || !(bool)$user->destroy($id)) {
            return redirect()->back()->withErrors(['msg' => __('User Not Exist!')]);
        }
        return redirect()->route('dashboard.users')->with(['success' => __('User Deleted!')]);

    }
}

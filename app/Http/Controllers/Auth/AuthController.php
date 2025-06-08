<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    // Login
    public function indexLogin()
    {
        return view('auth.login');
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        $authLogin = User::where('email', '=', $request->email)->first();
        if ($authLogin) {
            Session::put('loginId', $authLogin->id);
            return redirect()->route('std.index')->with('success', 'Login successfully.');
        } else {
            return redirect()->route('auth.index')->with('fail', 'Login unsuccessful.');
        }
    }

    // Register
    public function indexRegister()
    {
        return view('auth.register');
    }

    public function userRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['password'] = bcrypt($request->password);

        User::create($input);
        return redirect()->route('auth.index')->with('success', 'Created successfully.');
    }

    // Logout
    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect()->route('auth.index')->with('success', 'Logout successfully.');
        }
    }
}
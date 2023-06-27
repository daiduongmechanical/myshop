<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;


class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'home', 'update', 'adminLogout']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'token' => $token,
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        $user = Auth::user();


        if ($user->block === 1) {
            return response()->json([
                'token' => $token,
                'status' => 'error',
                'message' => 'account blocked',
            ], 400);
        }



        return response()->json([
            'status' => 'login success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',

            ]
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone
        ]);

        $token = Auth::login($user);
        $data = User::find($user->id);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $data,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function update(Request $reqest)
    {
        $data = $reqest->all();
        $action = new User();
        $result = $action->updateProfile($data);
        return $result;
    }

    public function resetPassword(Request $request)
    {
        $data = $request->all();
        $action = new User();
        $result = $action->resetPassword($data);
        return $result;
    }


    public function home()
    {
        return view('layout.layout');
    }

    public function adminLogout()
    {
        \session()->forget('auth');
        return redirect('/');
    }
}

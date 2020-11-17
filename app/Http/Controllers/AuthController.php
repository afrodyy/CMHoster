<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Vps;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->has('cari')) {
            $vps = Vps::where('nama', 'LIKE', '%' . $request->cari . '%')
                ->orWhere('ip_address', 'LIKE', '%' . $request->cari . '%')
                ->get();
        } else {
            $vps = Vps::all();
        }
        return view('auth.login', compact('vps'));
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect('/dashboard');
        } else {
            return redirect('/login')->with('warning', 'Sorry, your username or password was incorrect.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function cariVps(Request $request)
    {
        if ($request->has('cari')) {
            $vps = Vps::where('nama', 'LIKE', '%' . $request->cari . '%')->get();
        } else {
            $vps = Vps::all();
        }
        return view('auth.cariVps', compact('vps'));
    }
}

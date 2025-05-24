<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginCtrl extends Controller
{
    public function page()
    {
        return collect([
            "name" => "Login",
            "icon" => "bi bi-lock",
        ]);
    }

    public function index()
    {
        $name = $this->page()["name"];
        $slug = Str::slug($this->page()["name"]);
        $icon = $this->page()["icon"];
        $title  = "Halaman Login";

        return view("$slug.index", [
            "name" => $name,
            "slug" => $slug,
            "icon" => $icon,
            "title" => $title,
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with("success", "Login Berhasil");

        }

        return back()->with('danger', 'Silahkan periksa lagi username atau password Anda !!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->withSuccess("Anda berhasil logout");
    }
}

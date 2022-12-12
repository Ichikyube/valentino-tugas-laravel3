<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AuthController extends Controller
{
    function login(Request $request) {
        if ($request->method() == "GET") {
            return view("Login");
        }
        $email =$request->input("email");
        $password = $request->input("password");
        $pengguna = User::query()
        ->where("email", $email)
        ->first();
        if($pengguna == null) {
            return redirect()
                ->withErrors([
                    "msg" => "Email tidak ditemukan!"
                ])->back();
        }
        if(!Hash::check($password, $pengguna->password)) {
            return redirect()
            ->back()
            ->withErrors([
                'msg' => "Password salah!"
            ])->back();
        }
        if(!session()->isStarted()) session()->start();
        session()->put("logged", true);
        session()->put("idUser", $pengguna->id);
        return redirect()->route("homepage");
    }
    function logout() {
        session()->flush();
        return redirect()->route("login");
    }
}

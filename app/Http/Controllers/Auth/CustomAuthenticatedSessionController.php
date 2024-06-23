<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomAuthenticatedSessionController extends Controller
{
  public function store(Request $request)
    {
        // ログイン処理
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            // 認証成功
            return redirect()->intended('/home'); // ここで /home にリダイレクト
        }

        // 認証失敗
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}

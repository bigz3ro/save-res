<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use Validator;
use Illuminate\Support\Facades\Mail;
use Auth;

class AuthController extends Controller
{
    public function getLogin(Request $request)
    {
        if (Auth::user()) {
            return redirect()->route('user.index');
        }
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $rules = [
            'email' =>'required|email',
            'password' => 'required|min:6'
        ];
        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $email = $request->input('email');
            $password = $request->input('password');

            if( Auth::attempt(['email' => $email, 'password' => $password])) {
                return redirect()->route('user.index');
            } else {
                return redirect()->back()->withInput()->with(['error' => 'Email hoặc mật khẩu không đúng']);
            }
        }
    }

    public function logout(Request $request)
    {
        // Mail::to(Auth::user()->email)->send(new OrderShipped());
        Auth::logout();
        return redirect()->route('login');
    }

    public function forgotPassword()
    {

        return view('auth.passwords.email');
    }
}

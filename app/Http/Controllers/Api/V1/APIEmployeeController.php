<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Validator;
use JWTFactory;
use JWTAuth;
use LRedis;
use Illuminate\Support\Facades\Auth;

class APIEmployeeController extends Controller
{
    public function __construct()
    {
        Config::set('jwt.user', 'App\Employee');
        Config::set('auth.providers.users.model', \App\Employee::class);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'account' => 'required|max:255',
                'password'=> 'required'
            ],
            [
                'account.required' => 'Vui lòng nhập tài khoản',
                'account.max' => 'Độ dài vượt quá mức cho phép',
                'password.required' => 'Vui lòng nhập mật khẩu'
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $credentials = $request->only('account', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $redis = LRedis::connection();
        $payload = JWTAuth::getPayload($token)->toArray();
        $redis->set('token_'. $payload['sub'], $payload['sub']);
        $redirect = route('employee.index');

        return response()->json(compact('token', 'redirect'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Validator;

class UserController extends Controller
{
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('auth');
        $this->userRepo = $userRepo;
    }

    public function index(Request $request)
    {
        $options = [];
        $users = $this->userRepo->paginate($options, 15);

        return view('pages.users.index', compact('users'));
    }

    public function getCreate()
    {
        return view('pages.users.create');
    }

    public function postCreate(Request $request)
    {
        $rules = [
            'email' =>'required|email',
            'password' => 'required|min:6',
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
            $fullname = $request->input('fullname');

            $existUser = $this->userRepo->getByEmail($email);
            if ($existUser) {
                return redirect()->back()->with(['error' => 'Người dùng này đã tồn tài']);
            }
            $data = [
                'email' => $email,
                'password' => bcrypt($password),
                'fullname' => $fullname
            ];

            $newUser = $this->userRepo->create($data);
            if (!$newUser) {
                return redirect()->back()->withInput()->with(['error' => 'Tạo người dùng không thành công']);
            }
            return redirect()->route('user.index')->with(['success' => 'Tạo người dùng thành công']);
        }
    }

    public function getEdit()
    {
        return view('pages.user.edit');
    }

    // public function postEdit()

}

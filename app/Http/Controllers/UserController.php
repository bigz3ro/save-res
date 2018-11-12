<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Validator;
use App\Role;
use DB;
use Auth;

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
        $roles = Role::all();
        return view('pages.users.create', compact('roles'));
    }

    public function postCreate(Request $request)
    {
        $rules = [
            'fullname' => 'required',
            'email' => 'bail|required|email|unique:users,email',
            'password' => 'required|min:6',
            'password' => 'required|same:confirm_password',
            'role' => 'required'
        ];
        $messages = [
            'fullname.required' => 'Họ và tên là trường bắt buộc',
            'email.required' => 'Email là trường bắt buộc',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email không đúng định dạng',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.same' => 'Nhập lại mật khẩu không đúng',
            'role.required' => 'Role là trường bắt buộc'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'fullname' => $request->input('fullname'),
            'role' => $request->input('role'),
            'status' => config('user_status.status.active')
        ];

        $newUser = $this->userRepo->create($data);
        if (!$newUser) {
            return redirect()->back()->withInput()->with(['error' => 'Tạo người dùng không thành công']);
        }
        $newUser->attachRole($request->input('role'));
        return redirect()->route('user.index')->with(['success' => 'Tạo người dùng thành công']);
    }

    public function getEdit(Request $request)
    {
        $userId = $request->id;
        $user = $this->userRepo->find($userId);
        if(!$user) {
            return redirect()->route('user.index')->with('success', 'Người dùng này không tồn tại');
        }
        $roles = Role::all();
        $userRole = $user->roles->pluck('id')->all();

        return view('pages.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function postEdit(Request $request)
    {
        $rules = [
            'fullname' => 'required',
            'email' =>'required|email',
            'role' => 'required|integer',
            'status' => 'required'
        ];
        $messages = [
            'fullname.required' => 'Họ và tên là trường bắt buộc',
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'role.required' => 'Role là trường bắt buộc',
            'role.integer' => 'Role không tồn tại',
            'status.required' => 'Trạng thái người là trường bắt buộc'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = $request->id;
        $user = $this->userRepo->find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Người dùng này không tồn tại');
        }

        $data = [
            'email' => $request->email,
            'fullname' => $request->fullname,
            'role' => $request->role,
            'status' => $request->status
        ];
        $updatedUser = $this->userRepo->update($user, $data);
        if (!$updatedUser) {
            return redirect()->back()->with('error', 'Cập nhật không thành công');
        }
        return redirect()->route('user.getEdit', ['id' => $updatedUser->id])->with('success', 'Cập nhật thành công');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $user = $this->userRepo->find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Người dùng này không tồn tại');
        }
        if ($user->id == Auth::user()->id) {
            return redirect()->back()->with('error', 'Bạn không được xóa tài khoản của bạn');
        }
        DB::table("users")->where('id', $id)->delete();
        return redirect()->route('user.index')->with('success','Xóa người dùng thành công');
    }

}

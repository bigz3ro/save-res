<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\ImageRepository;
use Validator;
use App\Role;
use App\Organization;
use DB;
use Auth;

class UserController extends Controller
{
    public function __construct(UserRepository $userRepo, ImageRepository $imageRepo)
    {
        $this->middleware('auth');
        $this->userRepo = $userRepo;
        $this->imageRepo = $imageRepo;
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $options = [
            'keyword' => $keyword
        ];
        $users = $this->userRepo->paginate($options, 10);
        $organizations = Organization::all();

        return view('pages.users.index', compact('users', 'organizations', 'keyword'));
    }

    public function getCreate()
    {
        $roles = Role::all();
        $organizations = Organization::all();

        return view('pages.users.create', compact('roles', 'organizations'));
    }

    public function postCreate(Request $request)
    {
        $rules = [
            'fullname' => 'required',
            'email' => 'bail|required|email|unique:users,email',
            'password' => 'required|min:6',
            'password' => 'required|same:confirm_password',
            'organization' => 'required',
            'roles' => 'required'
        ];
        $messages = [
            'fullname.required' => 'Họ và tên là trường bắt buộc',
            'email.required' => 'Email là trường bắt buộc',
            'organization.required' => 'Doanh nghiệp là trường bắt buộc',
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

        $avatar = null;
        if ($request->avatar) {
            $avatar = $this->imageRepo->upload($request, 'avatar', config('user.max_image_width'), null, 'avatars/');
            if ($avatar['status'] == "error") {
                return redirect()->back()->withInput()->with(['error' => $avatar['message']]);
            }
        }

        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'fullname' => $request->input('fullname'),
            'status' => config('user_status.status.active'),
            'organization_id' => $request->input('organization'),
            'avatar' => $avatar['data']['name']
        ];
        $newUser = $this->userRepo->create($data);
        if (!$newUser) {
            return redirect()->back()->withInput()->with(['error' => 'Tạo người dùng không thành công']);
        }
         foreach ($request->input('roles') as $key => $value) {
            $newUser->attachRole($value);
        }
        return redirect()->route('user.index')->with(['success' => 'Tạo người dùng thành công']);
    }

    public function getEdit(Request $request)
    {
        $userId = $request->id;
        $user = $this->userRepo->find($userId);
        $organizations = Organization::all();

        if(!$user) {
            return redirect()->route('user.index')->with('success', 'Người dùng này không tồn tại');
        }
        $roles = Role::all();
        $userRole = $user->roles->pluck('id')->all();

        return view('pages.users.edit', compact('user', 'roles', 'userRole', 'organizations'));
    }

    public function postEdit(Request $request)
    {
        $rules = [
            'fullname' => 'required',
            'email' =>'required|email',
            'roles' => 'required',
            'status' => 'required',
            'organization' => 'required',
        ];
        $messages = [
            'fullname.required' => 'Họ và tên là trường bắt buộc',
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'role.required' => 'Role là trường bắt buộc',
            'role.integer' => 'Role không tồn tại',
            'status.required' => 'Trạng thái người là trường bắt buộc',
            'organization.required' => 'Doanh nghiệp là trường bắt buộc',
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

        $avatar = null;
        if ($request->avatar) {
            $avatar = $this->imageRepo->upload($request, 'avatar', config('user.max_image_width'), null, 'avatars/');
            if ($avatar['status'] == "error") {
                return redirect()->back()->withInput()->with(['error' => $avatar['message']]);
            }
        }

        $data = [
            'email' => $request->email,
            'fullname' => $request->fullname,
            'status' => $request->status,
            'avatar' => $avatar['data']['name'],
            'organization_id' => $request->organization
        ];
        $updatedUser = $this->userRepo->update($user, $data);
        if (!$updatedUser) {
            return redirect()->back()->with('error', 'Cập nhật không thành công');
        }


        DB::table("role_user")->where('user_id', $updatedUser->id)->delete();
        foreach ($request->input('roles') as $key => $value) {
            $updatedUser->attachRole($value);
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

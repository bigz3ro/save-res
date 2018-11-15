<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoleRepository;
use App\Permission;
use App\Role;
use Validator;
use DB;

class RoleController extends Controller
{
    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }

    public function index(Request $request)
    {
        $options = [];

        $roles = $this->roleRepo->paginate($options, 15);
        return view('pages.roles.index', compact('roles'));
    }

    public function getCreate(Request $request)
    {
        $permissions = Permission::get();
        return view('pages.roles.create', compact('permissions'));
    }

    public function postCreate(Request $request)
    {
        $rules = [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required|unique:roles,display_name',
            'description' => '',
        ];
        $messages = [
            'name.required' => 'Tên role là trường bắt buộc',
            'display_name.required' => 'Tên hiển thị role là trường bắt buộc',
            'name.unique' => 'Role đã tồn tại',
            'display_name.unique' => 'Tên hiển thị đã tồn tại',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ];
        $role = $this->roleRepo->create($data);

        if ($role) {
            foreach ($request->input('permission') as $key => $value) {
                $role->attachPermission($value);
            }
        }

        return redirect()->route('role.index')->with('success','Tạo role mới thành công');
    }

    public function getEdit(Request $request)
    {
        $id = intval($request->id);
        $role = $this->roleRepo->find($id);
        if (!$role) {
            return redirect()->route('role.index')->with('error', 'Role này không tồn tại');
        }
        $permissions = Permission::get();
        $rolePermissions = DB::table('permission_role')->where('permission_role.role_id', $id)->pluck('permission_id')->all();
        return view('pages.roles.edit', compact('permissions', 'role', 'rolePermissions'));
    }

    public function postEdit(Request $request)
    {
        $rules = [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required|unique:roles,display_name',
            'description' => '',
        ];
        $messages = [
            'name.required' => 'Tên role là trường bắt buộc',
            'display_name.required' => 'Tên hiển thị role là trường bắt buộc',
            'name.unique' => 'Role đã tồn tại',
            'display_name.unique' => 'Tên hiển thị đã tồn tại',
        ];

        $id = intval($request->id);
        $role = $this->roleRepo->find($id);
        if (!$role) {
            return redirect()->back()->with('error', 'Role này không tồn tại');
        }
        $data = [
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ];
        $role = $this->roleRepo->update($role, $data);
        if ($role) {
            DB::table("permission_role")->where("permission_role.role_id", $id)->delete();
            foreach ($request->input('permission') as $key => $value) {
                $role->attachPermission($value);
            }
        }

        return redirect()->route('role.index')->with('success','Cập nhật thành công');
    }


    public function delete(Request $request)
    {
        $id = intval($request->id);
        $role = $this->roleRepo->find($id);
        if (!$role) {
            return redirect()->back()->with('error', 'Role này không tồn tại');
        }
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('role.index')->with('success','Xóa thành công');
    }

}


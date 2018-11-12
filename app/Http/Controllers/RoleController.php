<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoleRepository;
use App\Permission;
use App\Role;
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
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'required',
            'permission' => 'required',
        ]);
        $role = new Role();
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();

        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }

        return redirect()->route('role.index')->with('success','Tạo role mới thành công');
    }

    public function getEdit(Request $request)
    {
        $id = $request->id;
        $role = Role::find($id);
        if (!$role) {
            return redirect()->route('role.index')->with('error', 'Role này không tồn tại');
        }
        $permissions = Permission::get();
        $rolePermissions = DB::table('permission_role')->where('permission_role.role_id', $id)->pluck('permission_id')->all();
        return view('pages.roles.edit', compact('permissions', 'role', 'rolePermissions'));
    }

    public function postEdit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required',
            'permission' => 'required',
        ]);

        $id = $request->id;
        $role = Role::find($id);
        if (!$role) {
            return redirect()->back()->with('error', 'Role này không tồn tại');
        }
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();

        DB::table("permission_role")->where("permission_role.role_id", $id)->delete();

        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }

        return redirect()->route('role.index')->with('success','Cập nhật thành công');
    }


    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Role::find($id);
        if (!$role) {
            return redirect()->back()->with('error', 'Role này không tồn tại');
        }
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('role.index')->with('success','Xóa thành công');
    }

}


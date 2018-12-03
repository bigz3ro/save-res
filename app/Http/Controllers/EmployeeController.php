<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeeRepository;
use App\Organization;
use Carbon\Carbon;
use DB;
use Auth;
use Validator;

class EmployeeController extends Controller
{
    public function __construct(EmployeeRepository $eplRepo)
    {
        $this->eplRepo = $eplRepo;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $moduleName = 'Nhân viên';
        $keyword = $request->input('keyword');
        $options = [
            'keyword' => $keyword,
            'organization_id' => Auth::user()->organization_id
        ];

        $organizations = Organization::all();
        $employees = $this->eplRepo->paginate($options, 10);

        return view('pages.employees.index', compact('moduleName', 'employees', 'organizations', 'keyword'));
    }

    public function getCreate(Request $request)
    {
        $moduleName = 'Nhân viên';
        $organizations = Organization::all();

        return view('pages.employees.create', compact('moduleName', 'organizations'));
    }

    public function postCreate(Request $request)
    {
        $rules = [
            'fullname' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'cmnd' => 'required',
            'account' => 'required',
            'password' => 'required'
            // 'organization' => 'required'
        ];
        $messages = [
            'fullname.required' => 'Họ và tên là trường bắt buộc',
            'address.required' => 'Địa chỉ là trường bắt buộc',
            'birthday.required' => 'Ngày sinh là trường bắt buộc',
            'phone.required' => 'Số điện thoại là trường bắt buộc',
            'gender.required' => 'Giới tính là trường bắt buộc',
            'cmnd.required' => 'Số CMND là trường bắt buộc',
            'account.required' => 'Tài khoản là trường bắt buộc',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            // 'organization.required' => 'Doanh nghiệp là trường bắt buộc'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $birthday = Carbon::createFromFormat('d/m/Y', $request->input('birthday'));
        $data = [
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'fullname' => $request->input('fullname'),
            // 'organization_id' => intval($request->input('organization')),
            'gender' => intval($request->input('gender')),
            'birthday' => $birthday,
            'cmnd' => $request->input('cmnd'),
            'organization_id' => Auth::user()->organization_id,
            'account' => $request->input('account'),
            'password' => bcrypt($request->input('password'))
        ];

        $newEpl = $this->eplRepo->create($data);
        if (!$newEpl) {
            return redirect()->back()->withInput()->with(['error' => 'Tạo Nhân viên không thành công']);
        }
        return redirect()->route('employee.index')->with(['success' => 'Tạo Nhân viên thành công']);
    }

    public function getEdit(Request $request)
    {
        $moduleName = "Nhân viên";
        $id = $request->id;
        $employee = $this->eplRepo->find($id);
        if(!$employee) {
            return redirect()->route('employee.index')->with('success', 'Nhân viên này không tồn tại');
        }
        $organizations = Organization::all();

        return view('pages.employees.edit', compact('employee', 'moduleName', 'organizations'));
    }

    public function postEdit(Request $request)
    {
        $rules = [
            'id' => 'required',
            'fullname' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'cmnd' => 'required',
            'organization' => 'required'
        ];
        $messages = [
            'id.required' => 'Mã nhân viên không tồn tại',
            'fullname.required' => 'Họ và tên là trường bắt buộc',
            'address.required' => 'Địa chỉ là trường bắt buộc',
            'birthday.required' => 'Ngày sinh là trường bắt buộc',
            'phone.required' => 'Số điện thoại là trường bắt buộc',
            'gender.required' => 'Giới tính là trường bắt buộc',
            'cmnd.required' => 'Số CMND là trường bắt buộc',
            'organization.required' => 'Doanh nghiệp là trường bắt buộc'
        ];
        $id = $request->id;
        $epl = $this->eplRepo->find($id);
        if (!$epl) {
            return redirect()->back()->with('error', 'Nhân viên này không tồn tại');
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $birthday = Carbon::createFromFormat('d/m/Y', $request->input('birthday'));
        $data = [
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'fullname' => $request->input('fullname'),
            'organization_id' => intval($request->input('organization')),
            'gender' => intval($request->input('gender')),
            'birthday' => $birthday,
            'cmnd' => $request->input('cmnd'),
        ];
        if ($request->input('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        $newEpl = $this->eplRepo->update($epl, $data);
        if (!$newEpl) {
            return redirect()->back()->withInput()->with(['error' => 'Tạo Nhân viên không thành công']);
        }
        return redirect()->route('employee.index')->with(['success' => 'Tạo Nhân viên thành công']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $epl = $this->eplRepo->find($id);
        if (!$epl) {
            return redirect()->back()->with('error', 'Nhân viên này không tồn tại');
        }
        DB::table("employees")->where('id', $id)->delete();
        return redirect()->route('employee.index')->with('success','Xóa nhân viên thành công');
    }

}

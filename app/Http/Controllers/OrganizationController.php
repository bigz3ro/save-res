<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organization;
use App\Repositories\OrganizationRepository;
use Auth;
use DB;
use Carbon\Carbon;
use Validator;

class OrganizationController extends Controller
{
   public function __construct(OrganizationRepository $organizationRepo)
    {
        $this->middleware('auth');
        $this->organizationRepo = $organizationRepo;
    }

    public function index(Request $request)
    {
        $options = [];
        $organizations = $this->organizationRepo->paginate($options, 15);

        return view('pages.organizations.index', compact('organizations'));
    }

    public function getCreate()
    {
        return view('pages.organizations.create');
    }

    public function postCreate(Request $request)
    {
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ];
        $messages = [
            'name.required' => 'Tên doanh nghiệp là trường bắt buộc',
            'address.required' => 'Địa chỉ là trường bắt buộc',
            'phone.unique' => 'Số điện thoại đã tồn tại',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $startTime = Carbon::createFromFormat('d/m/Y', $request->input('start_time'));
        $data = [
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'start_time' => $startTime
        ];

        $newOrganization = $this->organizationRepo->create($data);
        if (!$newOrganization) {
            return redirect()->back()->withInput()->with(['error' => 'Tạo không thành công']);
        }
        return redirect()->route('organization.index')->with(['success' => 'Tạo thành công']);
    }

    public function getEdit(Request $request)
    {
        $id = intval($request->id);
        $organization = Organization::find($id);
        if (!$organization) {
            return redirect()->route('organization.index')->with('error', 'Doanh nghiệp này không tồn tại');
        }
        return view('pages.organizations.edit', compact('organization'));
    }

    public function postEdit(Request $request)
    {
        $rules = [
            'name' => 'required',
            'address' =>'required',
            'phone' => 'required',
            'start_time' => ''
        ];
        $messages = [
            'name.required' => 'Tên doanh nghiệp là trường bắt buộc',
            'address.required' => 'Địa chỉ là trường bắt buộc',
            'phone.required' => 'Số điện thoại là trường bắt buộc',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = $request->id;
        $organization = Organization::find($id);
        if (!$organization) {
            return redirect()->back()->with('error', 'Người dùng này không tồn tại');
        }

        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ];
        if ($request->input('start_time')) {
            $data['start_time'] = Carbon::createFromFormat('d/m/Y', $request->input('start_time'));
        }
        $updatedOrganization = $this->organizationRepo->update($organization, $data);
        if (!$updatedOrganization) {
            return redirect()->back()->with('error', 'Cập nhật không thành công');
        }
        return redirect()->route('organization.getEdit', ['id' => $updatedOrganization->id])->with('success', 'Cập nhật thành công');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $organization = Organization::find($id);
        if (!$organization) {
            return redirect()->back()->with('error', 'Doanh nghiệp này không tồn tại');
        }
        DB::table("organizations")->where('id', $id)->delete();
        return redirect()->route('organization.index')->with('success','Xóa thành công');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TableZone;
use App\Repositories\TableRepository;
use Validator;
use DB;
use Auth;

class TableController extends Controller
{
    public function __construct(TableRepository $tableRepo)
    {
        $this->tableRepo = $tableRepo;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $options = [
            'keyword' => $keyword,
            'organization_id' => Auth::user()->organization_id
        ];
        $tables = $this->tableRepo->paginate($options, 15);

        return view('pages.tables.index', compact('tables', 'keyword'));
    }

    public function getCreate()
    {
        return view('pages.tables.create');
    }

    public function postCreate(Request $request)
    {
        $rules = [
            'name' => 'required',
            'location' => 'required',
            'description' => '',
        ];
        $messages = [
            'name.required' => 'Tên bàn là trường bắt buộc',
            'location.required' => 'Vị trí là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'description' => $request->input('description'),
            'organization_id' => Auth::user()->organization_id
        ];
        $newTable = $this->tableRepo->create($data);
        if (!$newTable) {
            return redirect()->back()->withInput()->with(['error' => 'Tạo bàn không thành công']);
        }
        return redirect()->route('table.index')->with(['success' => 'Tạo bàn thành công']);
    }

    public function getEdit(Request $request)
    {
        $id = $request->id;
        $table = $this->tableRepo->find($id);
        if(!$table) {
            return redirect()->route('table.index')->with('success', 'Người dùng này không tồn tại');
        }

        return view('pages.tables.edit', compact('table'));
    }

    public function postEdit(Request $request)
    {
        $rules = [
            'name' => 'required',
            'location' =>'required',
            'description' => '',
        ];
        $messages = [
            'name.required' => 'Tên bàn là trường bắt buộc',
            'location.required' => 'Vị trí là trường bắt buộc',
            'description.required' => 'Mô tả là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = $request->id;
        $table = $this->tableRepo->find($id);
        if (!$table) {
            return redirect()->back()->with('error', 'Bàn này không tồn tại');
        }

        $data = [
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
        ];
        $updatedTable = $this->tableRepo->update($table, $data);
        if (!$updatedTable) {
            return redirect()->back()->with('error', 'Cập nhật không thành công');
        }
        return redirect()->route('table.getEdit', ['id' => $updatedTable->id])->with('success', 'Cập nhật thành công');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $table = $this->tableRepo->find($id);
        if (!$table) {
            return redirect()->back()->with('error', 'Bàn này không tồn tại');
        }
        DB::table("table_zones")->where('id', $id)->delete();
        return redirect()->route('table.index')->with('success','Xóa thành công');
    }
}

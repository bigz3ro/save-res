<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Repositories\ButtonRepository;
use Validator;
use App\Button;
use Auth;

class ButtonController extends Controller
{
    public function __construct(ButtonRepository $buttonRepo)
    {
        $this->buttonRepo = $buttonRepo;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $keyword = $request->input("keyword");
        $options = [
            'keyword' => $keyword,
            'organization_id' => Auth::user()->organization_id
        ];

        $buttons = $this->buttonRepo->paginate($options, 10);
        return view('pages.buttons.index', compact('buttons', 'keyword'));
    }

    public function getCreate(Request $request)
    {
        return view('pages.buttons.create');
    }

    public function postCreate(Request $request)
    {
        $rules = [
            'serial_number' => 'required',
            'command' => 'required',
        ];

        $messages = [
            'serial_number.required' => 'Serial number là trường bắt buộc',
            'command.required' => 'Command là trường bắt buộc',
        ];
        $serialNumber = $request->input('serial_number');
        $exitButton = Button::where('serial_number', $serialNumber)->where('organization_id', Auth::user()->organization_id)->first();
        if ($exitButton) {
            return redirect()->back()->withInput()->with(['error' => 'Nút bấm đã tồn tại']);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'serial_number' => $request->input('serial_number'),
            'command' => $request->input('command'),
            'organization_id' => Auth::user()->organization_id
        ];
        $newButton = $this->buttonRepo->create($data);
        if (!$newButton) {
            return redirect()->back()->withInput()->with(['error' => 'Tạo nút bấm không thành công']);
        }
        return redirect()->route('button.index')->with(['success' => 'Tạo nút bấm thành công']);
    }

    public function getEdit(Request $request)
    {
        $id = $request->id;
        $button = $this->buttonRepo->find($id);
        if(!$button) {
            return redirect()->route('button.index')->with('success', 'Nút bấm này không tồn tại');
        }

        return view('pages.buttons.edit', compact('button'));
    }

    public function postEdit(Request $request)
    {
        $rules = [
            'serial_number' => 'required',
            'command' => 'required',
        ];

        $messages = [
            'serial_number.required' => 'Serial number là trường bắt buộc',
            'command.required' => 'Command là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = $request->id;
        $button = $this->buttonRepo->find($id);
        if (!$button) {
            return redirect()->back()->with('error', 'Bàn này không tồn tại');
        }

        $data = [
            'serial_number' => $request->input('serial_number'),
            'command' => $request->input('command'),
        ];
        $updatedButton = $this->buttonRepo->update($button, $data);
        if (!$updatedButton) {
            return redirect()->back()->with('error', 'Cập nhật không thành công');
        }
        return redirect()->route('button.getEdit', ['id' => $updatedButton->id])->with('success', 'Cập nhật thành công');
    }

    public function delete(Request $request)
    {

    }
}

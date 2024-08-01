<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerCreateRequest;
use App\Http\Requests\ManagerUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ManagerController extends Controller
{
    const PATH_VIEW = "admin.manager.";

    public function index()
    {
        $data = User::where('role', 'admin')->latest("id")->paginate(6);
        return view(self::PATH_VIEW . __FUNCTION__, compact("data"));
    }

    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function store(ManagerCreateRequest $request)
    {
        // dd($request->all());

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        Log::channel('customer')->info(Auth::user()->name . " đã tạo 1 người quản trị có tên là: " . $request->name);

        return redirect()->route('admin.managers.index')->with("success", "Create manager successfully");
    }

    public function changeUser($id)
    {
        $user = User::where("id", $id)->first();
        $user->update(
            ["role" => "member"]
        );
        Log::channel('customer')->info("Đã thay đổi: " . $user->name . " thành người dùng");


        return redirect()->route("admin.users.index")->with("success", "Change user successfully");
    }

    public function edit(string $id)
    {
        $model = User::where("id", $id)->first();
        return view(self::PATH_VIEW . __FUNCTION__, compact("model"));
    }

    public function update(ManagerUpdateRequest $request, string $id)
    {
        $user = User::where('id', $id)->first();
        $currentNameUser = $user->name;

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        Log::channel('customer')->info(Auth::user()->name . " đã sửa 1 người quản trị có tên là: " . $currentNameUser);

        return redirect()->route('admin.managers.index')->with("success", "Edit manager successfully");
    }

    public function destroy(string $id)
    {
        $user = User::where("id", $id)->firstOrFail();
        Log::channel('customer')->info(Auth::user()->name . " đã xóa 1 người quản trị có tên là: " . $user->name);
        $user->delete();

        return redirect()->route("admin.managers.index")->with("success", "Delete manager successfully");
    }
}

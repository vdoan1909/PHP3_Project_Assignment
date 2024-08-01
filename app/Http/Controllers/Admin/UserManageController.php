<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserExamExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserManageCreateRequest;
use App\Http\Requests\UserManageUpdateRequest;
use App\Models\User;
use App\Models\UserExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class UserManageController extends Controller
{
    const PATH_VIEW = "admin.user.";

    public function index()
    {
        $data = User::where('role', 'member')->latest("id")->paginate(6);
        return view(self::PATH_VIEW . __FUNCTION__, compact("data"));
    }

    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function store(UserManageCreateRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Log::channel('customer')->info(Auth::user()->name . " đã tạo 1 người dùng có tên là: " . $request->name);
        return redirect()->route('admin.users.index')->with("success", "Create user successfully");
    }

    public function changeAdmin($id)
    {
        $user = User::where("id", $id)->first();
        $user->update(
            ["role" => "admin"]
        );

        Log::channel('customer')->info("Đã thay đổi: " . $user->name . " thành người quản trị");

        return redirect()->route("admin.managers.index")->with("success", "Change user successfully");
    }

    public function edit(string $id)
    {
        $model = User::where("id", $id)->first();
        return view(self::PATH_VIEW . __FUNCTION__, compact("model"));
    }

    public function update(UserManageUpdateRequest $request, string $id)
    {
        $user = User::where('id', $id)->first();
        $currentNameUser = $user->name;

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Log::channel('customer')->info(Auth::user()->name . " đã sửa 1 người dùng có tên là: " . $currentNameUser);

        return redirect()->route('admin.users.index')->with("success", "Edit user successfully");
    }

    public function destroy(string $id)
    {
        $user = User::where("id", $id)->firstOrFail();
        Log::channel('customer')->info(Auth::user()->name . " đã xóa 1 người dùng có tên là: " . $user->name);
        $user->delete();

        return redirect()->route("admin.users.index")->with("success", "Delete user successfully");
    }

    public function viewAchievement($id)
    {
        $user = User::where("id", $id)->select("id", "name")->first();
        $user_achievement = UserExam::where("user_id", $id)->with(["user", "exam"])->get();
        // dd($user_achievement->toArray());

        return view(self::PATH_VIEW . __FUNCTION__, compact("user_achievement", "user"));
    }

    public function export($user_id)
    {
        $user = User::where("id", $user_id)->first();
        $filename = "{$user->name}.xlsx";
        return Excel::download(new UserExamExport($user_id), $filename);
    }

    public function changeActive(Request $request, $id)
    {
        $user = User::where("id", $id)->first();

        if ($user->active_status == 0) {
            $user->active_status = 1;
            $user->save();
            Log::channel('customer')->info("Đã sửa trạng thái người dùng: " . $user->name . " từ hoạt động sang không hoạt động");
        } else {
            $user->active_status = 0;
            $user->save();
            Log::channel('customer')->info("Đã sửa trạng thái người dùng: " . $user->name . " từ không hoạt động sang hoạt động");
        }


        return redirect()->back()->with("success", "Update user successfully");
    }
}

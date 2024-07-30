<?php

namespace App\Http\Controllers\Admin;

use App\Events\RegisterCompleted;
use App\Exports\UserExamExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserExam;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($user) {
            RegisterCompleted::dispatch(["username" => $request->name, "email" => $request->email]);
        }

        return redirect()->route('admin.users.index')->with("success", "Create user successfully");
    }

    public function changeAdmin($id)
    {
        User::where("id", $id)->update(
            ["role" => "admin"]
        );

        return redirect()->route("admin.managers.index")->with("success", "Change user successfully");
    }

    public function edit(string $id)
    {
        $model = User::where("id", $id)->first();
        return view(self::PATH_VIEW . __FUNCTION__, compact("model"));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8|same:password',
        ]);

        $user = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index')->with("success", "Edit user successfully");
    }

    public function destroy(string $id)
    {
        $user = User::where("id", $id)->firstOrFail();
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
}

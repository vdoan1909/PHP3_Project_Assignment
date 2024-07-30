<?php

namespace App\Http\Controllers\Admin;

use App\Events\RegisterCompleted;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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

        return redirect()->route('admin.users.index')->with("success", "Create manager successfully");
    }

    public function changeUser($id)
    {
        User::where("id", $id)->update(
            ["role" => "member"]
        );

        return redirect()->route("admin.users.index");
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
        ]);

        $user = User::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.users.index')->with("success", "Edit manager successfully");
    }


    public function destroy(string $id)
    {
        $user = User::where("id", $id)->firstOrFail();
        $user->delete();

        return redirect()->route("admin.users.index")->with("success", "Delete manager successfully");
    }
}

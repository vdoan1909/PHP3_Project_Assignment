<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserSubject;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\User;

class UserSubjectController extends Controller
{
    const PATH_VIEW = "client.subject.";

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $get_user = User::find($request->user_id);

        if (!$get_user) {
            return redirect()->route("login");
        }

        $get_user_subject = UserSubject::where("user_id", $request->user_id)
            ->where("subject_id", $request->subject_id)
            ->first();

        if ($get_user_subject) {
            return back()->with("user_subject_warning", "Bạn đã đăng ký rồi !");
        }

        try {
            UserSubject::create($data);
            return back()->with("user_subject_success", "Đăng ký thành công !");
        } catch (\Exception $e) {
            return back()->with("user_subject_error", $e);
        }
    }

    public function show(string $slug)
    {
        $subject = Subject::where("slug", $slug)->firstOrFail();
        return view(self::PATH_VIEW . __FUNCTION__, compact("subject"));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}

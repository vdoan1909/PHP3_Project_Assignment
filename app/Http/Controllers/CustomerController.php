<?php

namespace App\Http\Controllers;

use App\Exports\UserExamExport;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\User;
use App\Models\UserExam;
use App\Models\UserSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    const PATH_VIEW = "client.customer.";

    public function show()
    {
        $get_user_exam = UserExam::with("exam")
            ->where("user_id", Auth::User()->id)
            ->get();

        $get_user_subject = UserSubject::with("subject")
            ->where("user_id", Auth::User()->id)
            ->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact("get_user_exam", "get_user_subject"));
    }

    public function updateCustomer(CustomerUpdateRequest $request)
    {
        $customer = User::where("id", Auth::id())->first();
        $currentNameCustomer = $customer->name;

        $customer->update(
            [
                "name" => $request->name,
            ]
        );

        Log::channel('customer')->info($currentNameCustomer . " đã cập nhật tài khoản của mình");

        return back()->with("change_success", "Thông tin đã được cập nhật");
    }

    public function export($user_id)
    {
        $user = User::where("id", $user_id)->first();
        $filename = "{$user->name}.xlsx";
        return Excel::download(new UserExamExport($user_id), $filename);
    }
}

<?php

namespace App\Http\Controllers;

use App\Functions\MailFunction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\ResetMail;

class AuthController extends Controller
{
    public function _auth()
    {
        return view('auth.login');
    }

    public function _forgot()
    {
        return view('auth.forgot');
    }

    public function _reset($token)
    {
        return view('auth.reset', compact('token'));
    }

    public function auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return Redirect::route('views.login')->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return Redirect::route('views.dashboard.show');
        }

        return Redirect::route('views.login')->with([
            'message' => 'تفاصيل تسجيل الدخول غير صحيحة',
            'type' => 'error'
        ]);
    }

    public function forgot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.forgot")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        if(!MailFunction::forgot($request->email)) {
            return Redirect::route("views.forgot")->with([
                'message' => "المستخدم غير موجود",
                'type' => 'error'
            ]);
        }
        
        return Redirect::route("views.forgot")->with([
            'message' => "تحقق من بريدك الإلكتروني لإعادة تعيين الرمز السري",
            'type' => 'success'
        ]);
    }

    public function reset(Request $request, $token)
    {
        $validator = Validator::make($request->all(), [
            'newPassword' => ['required', 'string'],
            'confirmPassword' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.reset", $token)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $row = DB::table('password_resets')->where('token', $token)->first();

        if (!$row) {
            return Redirect::route("views.reset", $token)->with([
                'message' => 'الرابط غير صالح',
                'type' => 'error'
            ]);
        }

        $user = User::where('email', $row->email)->first();

        if (!$user) {
            return Redirect::route("views.reset", $token)->with([
                'message' => "المستخدم غير موجود",
                'type' => 'error'
            ]);
        }

        if ($request->newPassword != $request->confirmPassword) {
            return Redirect::route("views.reset", $token)->with([
                'message' => 'الرمز السري غير متطابق',
                'type' => 'error'
            ]);
        }

        DB::table('password_resets')->where('token', $token)->delete();
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return Redirect::route("views.login")->with([
            'message' => 'تم التحديث بنجاح',
            'type' => 'success'
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::route("views.login")->with([
            'message' => 'تم تسجيل الخروج بنجاح',
            'type' => 'success'
        ]);
    }
}

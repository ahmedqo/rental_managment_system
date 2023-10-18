<?php

namespace App\Http\Controllers;

use App\Functions\MailFunction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        $data = User::orderBy('id', 'DESC')->get();
        return view('user.index', compact('data'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function edit($id)
    {
        $data = User::findorfail($id);
        return view('user.edit', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'string', 'unique:users'],
            'identity' => ['required', 'string', 'unique:users'],
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'address' => ['required', 'string'],
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'zipcode' => ['required', 'string'],
            'birthDate' => ['required', 'string'],
            'gender' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.users.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        User::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'identity' => $request->identity,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'birthDate' => $request->birthDate,
            'gender' => $request->gender,
        ]);

        MailFunction::forgot($request->email);
        return Redirect::route('views.users.index')->with([
            'message' => 'تم الإنشاء بنجاح',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:users,email,' . $id],
            'phone' => ['required', 'string', 'unique:users,phone,' . $id],
            'identity' => ['required', 'string', 'unique:users,identity,' . $id],
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'address' => ['required', 'string'],
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'zipcode' => ['required', 'string'],
            'birthDate' => ['required', 'string'],
            'gender' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.users.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        User::findorfail($id)->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'identity' => $request->identity,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'birthDate' => $request->birthDate,
            'gender' => $request->gender,
        ]);

        return Redirect::route('views.users.index')->with([
            'message' => 'تم التحديث بنجاح',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        User::findorfail($id)->delete();

        return Redirect::route('views.users.index')->with([
            'message' => 'تم الحذف بنجاح',
            'type' => 'success'
        ]);
    }
}

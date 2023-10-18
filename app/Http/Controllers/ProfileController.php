<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function password()
    {
        return view('profile.password');
    }

    public function edit()
    {
        $data = Auth::user();
        return view('profile.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $data = Auth::user();

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'unique:users,email,' . $data->id],
            'phone' => ['required', 'string', 'unique:users,phone,' . $data->id],
            'identity' => ['required', 'string', 'unique:users,identity,' . $data->id],
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
            return Redirect::route("views.profile.edit", $data->id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        User::findorfail($data->id)->update([
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

        return Redirect::route('views.profile.edit')->with([
            'message' => 'تم التحديث بنجاح',
            'type' => 'success'
        ]);
    }

    public function change(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => ['required', 'string'],
            'newPassword' => ['required', 'string'],
            'confirmPassword' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route('views.profile.password')->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        if (!Hash::check($request->oldPassword, Auth::user()->password)) {
            return Redirect::route('views.profile.password')->with([
                'message' => 'Old password missmatch',
                'type' => 'error'
            ]);
        }

        if ($request->newPassword != $request->confirmPassword) {
            return Redirect::route('views.profile.password')->with([
                'message' => 'Confirm password missmatch',
                'type' => 'error'
            ]);
        }

        $password = Hash::make($request->newPassword);
        User::find(Auth::user()->id)->update([
            "password" => $password
        ]);

        return Redirect::route('views.profile.password')->with([
            'message' => 'تم التحديث بنجاح',
            'type' => 'success'
        ]);
    }
}

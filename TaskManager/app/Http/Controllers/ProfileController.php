<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileEditRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function profile() {
        return view('profile');
    }

    public function profileEdit(ProfileEditRequest $request) {
        $user = User::where('email', '=', Auth::user()->email)->first();

        if($user == null)
            return Redirect::back()->withErrors(['smw' => 'Something went wrong']);

        if(($newUser = User::where('email', '=', $request->email)->first()) != null && $newUser != $user)
            return Redirect::back()->withErrors(['emt' => 'The email has already been taken!']);

        if ($request->password != $request->password_confirmation)
            return Redirect::back()->withErrors(['pdm' => 'Passwords doesn\'t match!']);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($user->save()) return Redirect::back()->with('success', 'New item has been successfully added!');
        else return Redirect::back()->withErrors('smw', 'Something went wrong!');
    }
}

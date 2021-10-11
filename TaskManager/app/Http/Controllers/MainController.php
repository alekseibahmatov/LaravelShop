<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class MainController extends Controller
{
    public function home() {
        return view('main');
    }

    public function processRegister(RegisterRequest $request) {
        $user = new User;

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        if($user->save()) auth()->login($user);

        return redirect(route('home'));
    }

    public function processLogin(LoginRequest $request) {
        $user = User::where('email', '=', $request->email)->first();

        if ($user != null) {
            if (Hash::check($request->password, $user->password)) {
                auth()->login($user);
                return redirect(route('user.profile'));
            } else {
                return Redirect::back()->withErrors(['pdm' => 'Password is incorrect!']);
            }
        } else {
            return Redirect::back()->withErrors(['unf' => 'User is not found!']);
        }
    }
}

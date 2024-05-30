<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller {

    public function logout(Request $request) {
        auth()->logout();
        return redirect('/');
    }
    public function register(Request $request) {
        $income = $request->validate([
            "name" => ["required", "string", "min:3", "max:25"],
            "email" => ["required", "email", "min:5", Rule::unique('users', 'email')],
            "password" => ["required", "string", "min:7", "max:25"],
        ]);
        $income['password'] = bcrypt($income['password']);
        $user = User::create($income);
        auth()->login($user);
        return redirect('/');
    }
}

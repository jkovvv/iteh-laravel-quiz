<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => ['required', Rule::unique('users','name')],
            'email' => ['required', 'email', Rule::unique('users','email')],
            'password' => ['required']
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        auth()->login($user);
        return response()->json(['message' => 'User registered successfully!'], 201);
    }

    public function logout(){
        auth()->logout();
        return response()->json(['message' => 'User logged out successfully!']);
    }

    public function login(Request $request){
        $incoming_fields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);
        if(auth()->attempt(['name'=>$incoming_fields['loginname'], 'password'=>$incoming_fields['loginpassword']])){
            $request->session()->regenerate();

            $user = Auth::user();
            $token = $user->createToken('Quiz')->plainTextToken;

            return response()->json(['message' => 'User logged in successfully!', 'token' => $token]);
        }
        else{
            return response()->json(['message' => 'Invalid credentials.']);
        }
    }
}
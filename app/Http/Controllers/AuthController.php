<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function getLogin(){
        return view("Auth.login");
    }

    public function getRegister(){
        return view("Auth.register");
    }

    public function register(Request $request){

        $inputValidation = Validator::make($request->all(), [
            "name" => 'required',
            "email" => 'required|unique:users,email',
            "password" => 'required|confirmed',
        ]);
        if($inputValidation->fails()){
            return redirect()->back()->withErrors($inputValidation)->withInput();
        }
        $user = User::create([
                    "name" => $request->name,
                    "email" => $request->email,
                    "password" => Hash::make($request->password),
                ]);

        return redirect('/login')->with('success', 'Successfully Registered.');
    }

    public function login(Request $request){

        $inputValidation = Validator::make($request->all(), [
            "email" => 'required|email',
            "password" => 'required',
        ]);
        if($inputValidation->fails()){
            return redirect()->back()->withErrors($inputValidation)->withInput();
        }
        if( Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
            ]) ){
            $user = Auth::user();
            return redirect('/dashboard');
        }else{
            return redirect()->back()->withInput()->with('error', 'Email and Passwrod does not match.');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiBaseController;

class ApiAuthController extends ApiBaseController
{
    public function signUp(Request $request)  {

        $validate = Validator::make($request->all(), [
            "name" => 'required',
            "email" => 'required|email|max:255|unique:'.User::class,
            'password' => 'required|min:6',

        ]);

        if ($validate->fails()) {
            return $this->sendErrorResponse($validate->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return [
            "success" => true,
            "token" => "Bearer " . $user->createToken('DETL', ['user'])->plainTextToken,
            "message" => "Register Successfully!",
            "data" => $user,
            "status" => 200,

        ];

    }

    public function signIn(Request $request)  {

        $validator = Validator::make($request->all(), [
            "email" => 'required|email',
            "password"    => "required|min:6",
        ]);

        if ($validator->fails()) {
            return $this->sendErrorResponse($validator->errors());
        }
        $credential = Auth::attempt(['email' => $request->email, 'password' => $request->password,]);
        if ($credential) {
            $user = Auth::user();
            return [
                "success" => true,
                "token" => "Bearer " . $user->createToken('DETL', ['user'])->plainTextToken,
                "message" => "Login Successfully!",
                "data" => $user,
                "status" => 200,

            ];
        } else {
            return $this->sendErrorResponse(null,"Credentials does not match!");
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        return $this->sendMessageResponse('Register successfully');

    }
}

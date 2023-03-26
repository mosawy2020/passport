<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (!$token = Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            return response()->json(['status' => 'fail', 'data' => null, 'message' => trans('auth.failed')], 422);
        $user = auth()->user();
        $user->token = $user->createToken('Geeks Token')->accessToken;
        return UserResource::make($user)->additional(['status' => 'success', 'message' => '']);


    }

}

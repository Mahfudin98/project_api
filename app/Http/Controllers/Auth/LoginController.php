<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class LoginController extends Controller
{
    protected $redirectTo = '/';

    public function Login(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );

        $user = User::where('email', $request->email)->first();
        if (Hash::check($request->password, $user->getAuthPassword())) {
            $token = $user->createToken(time());
            return response()->json(['status' => 'success', 'API-KEY-TEST' => $token->plainTextToken], 200);
        }
        return response()->json(['error' => 'Not authorized.'],403);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
    }

}

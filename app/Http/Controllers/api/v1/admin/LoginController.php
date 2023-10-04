<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    /**
     * Login to the Jobportals.Only verified user can login.
     */
    public function login(LoginRequest $request)
    {
        try {
            $user = User::orWhere('email', $request->username)->orWhere('phone_number', $request->username)->first();
            if ($user) {
                if (!Hash::check($request['password'], $user->password)) {
                    return ResponseHelper::errorWithMessageAndStatus(__('passwords.failed'), Response::HTTP_UNPROCESSABLE_ENTITY);
                }
                Auth::login($user);
                $user->token = $user->createToken('authToken')->accessToken;
                return ResponseHelper::success(new UserResource($user));
            }
            return ResponseHelper::errorWithMessageAndStatus(__('passwords.user'), Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return ResponseHelper::errorWithStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
    /**
     * logout from admin and users.
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return ResponseHelper::successWithMessage(__('common.logout'));
    }

}

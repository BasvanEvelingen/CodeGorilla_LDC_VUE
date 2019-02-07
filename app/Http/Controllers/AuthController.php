<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

/**
 * @author Bas van Evelingen <BasvanEvelingen@me.com>
 * @version 1.0.1
 * Class for handling all user authentication
 */
class AuthController extends Controller
{
    /**
     * @author Bas van Evelingen <BasvanEvelingen@me.com>
     * @version 1.0.1
     *
     * @param Request $request with all form data from vue.js
     * @return success or fail message
     */
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors(),
            ], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['status' => 'success'], 200);

    }

    /**
     * @author Bas van Evelingen <BasvanEvelingen@me.com>
     * @version 1.0.1
     * Method for authenticating user
     * @param Request $request with users credentials from form in vue.js
     * @return success or fail message and redirect if succesful.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'login_error'], 401);
    }

    public function logout()
    {
        dd("logout");
        $this->guard()->logout();

        return response()->json([
            'status' => 'success',
            'msg' => 'Succesvol uitgelogd.'], 200);
    }

    /**
     * @author Bas van Evelingen <BasvanEvelingen@me.com>
     * @version 1.0.0
     * Method for getting current user
     * @param $request
     * @return User data of current user
     */
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);

        return response()->json([
            'status' => 'success',
            'data' => $user,
        ]);
    }

    /**
     * @author Bas van Evelingen <BasvanEvelingen@me.com>
     * @version 1.0
     * Method for refreshing new JWT-token whenever neccessary
     * @return new JWT Token or 401 on error
     */
    public function refresh()
    {
        dd(' die');
        try
        {
            if ($token = JWTAuth::getToken()) {
                JWTAuth::checkOrFail();
            }
            $user = JWTAuth::authenticate();
        } catch (TokenExpiredException $e) {
            $refreshed = JWTAuth::refresh(JWTAuth::getToken());
            $user = JWTAuth::setToken($refreshed)->toUser();

            //JWTAuth::setToken(JWTAuth::refresh());
            $user = JWTAuth::authenticate();
        }
        if ($user/*&& check $user against parameter or not*/) {
            return response()
                ->json(['status' => 'success'], 200)
                ->header('Authorization', $token);
        } else {
            return response()->json(false, 401);
        }
    }

    /**
     * @author Bas van Evelingen <BasvanEvelingen@me.com>
     * Deprecated in favour of refresh()
     *
     * @return void
     */
    public function refreshToken()
    {

        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'success'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    private function guard()
    {
        return Auth::guard();
    }
}

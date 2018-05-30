<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Illuminate\Http\Response as HttpResponse;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $credentials = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        try {
            $credentials['password'] = bcrypt($credentials['password']);

            $user = User::firstOrNew(['email' => $request->email]);

            $user->fill($credentials);

            $status = $user->save();

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User already exists.',
                'status' => 0],
                HttpResponse::HTTP_CONFLICT);
        }

        $token = JWTAuth::fromUser($user);

        //Add token to the user array
        $user['token'] = $token;

        return response()->json([
            'message' => 'Registration successful. You may now log in.',
            'status' => $status
        ]);
    }

    public function login(Request $request)
    {
        //get credentials from the request
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);


        if($validator->fails()) {
            return response()->json([
                'message' => 'Email and Password fields must be filled out',
                'status' => 0,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['message' => 'could_not_create_token'], 500);
        }

        $user = User::where('email', $request->email)->first();

        $login_response = [
            'message' => 'Login successful',
            'token' => $token,
            'user'  => $user
        ];

        return response()->json(['data' => $login_response]);

    }
}

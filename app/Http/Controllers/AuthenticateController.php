<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class AuthenticateController extends Controller
{
    public function index()
    {
        // TODO: show users
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (! $token = )) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (Exception $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a token
        return response()->json(compact('token'));
    }
}

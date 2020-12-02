<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facades\UserFacade;
use Illuminate\Http\Response;
use Auth;
use Hash;

class AuthController extends Controller
{

	/**
	*
	* Login
	*
	* @param Illuminate\Http\Request $request
	* @return mixed
	*
	*/
    public function login(Request $request) {
    	$data = $request->validate([
    		'email' => ['required', 'string'],
    		'password' => ['required', 'string']
    	]);


    	if(Auth::attempt(['email'=> $request['email'], 'password' => $request['password']])) {

    		$user = auth()->user();
    
    		$user->access_type = 'Bearer';
    		$user->access_token = $user->createToken('auth')->accessToken;

    		return response()->json($user);
    	}

    	return response()->json(['message' => 'invalid email or password'], Response::HTTP_UNAUTHORIZED);

    }


    /**
	*
	* Register
	*
	* @param Illuminate\Http\Request $request
	* @return mixed
	*
	*/
    public function register(Request $request) {
    	$data = $request->validate([
    		'name' => ['required', 'string'],
    		'email' => ['required', 'string', 'unique:users,email'],
    		'password' => ['required', 'string']
    	]);

    	$data['password'] = Hash::make($data['password']);

    	$user = UserFacade::model()::create($data);

    	$user->access_type = 'Bearer';
    	$user->access_token = $user->createToken('auth')->accessToken;

    	return response()->json($user);



    }
}

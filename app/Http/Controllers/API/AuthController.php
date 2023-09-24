<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Function that performs login
     *
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    /**
     * Function that performs register
     *
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'is_admin' =>  'boolean',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->is_admin ?? false,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            return response()->json([
                'message' => 'Error',
            ], 400);
        }

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    /**
     * Function that performs logout
     *
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    /**
     * Function that performs refresh
     *
     */
    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }


    /**
     * List all users or a single user if you have the id .
     *
     * @param $id_atendimento
     */
    public function get(Int $id = null) {
        $is_admin = auth()->user()->is_admin;
        $id_user  = Auth::id();

        if($is_admin){
            $id_user = null;
        }

        if($id){
            $data = User::getById($id, $id_user);
            return $data;
        }

        $data = User::getAll($id_user);
        return $data;
    }

    /**
     * Change one user .
     *
     * @param $id
     */
    public function update(Int $id, Request $request) {
        $is_admin = auth()->user()->is_admin;
        $id_user  = Auth::id();

        if($is_admin){
            $id_user = null;
        }
        $request->validate([
            'name'          => 'string|max:255',
            'email'         => 'string|max:255',
            'password'      => 'string',
            'is_admin'      => 'boolean'
        ]);

        $user = User::updateReg($id, $request, $id_user);

        if($user == false){
            return response()->json(null,404);
        }
    }

    /**
     * Delete one user .
     *
     * @param $id
     */
    public function delete(Int $id) {
        $is_admin = auth()->user()->is_admin;
        $id_user  = Auth::id();

        if($is_admin){
            $id_user = null;
        }

        $user = User::deleteReg($id, $id_user);

        if($user == false){
          return response()->json(null,404);
        }
    }
}

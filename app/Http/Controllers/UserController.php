<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return response(['users' => UserResource::collection($users), 'status' => 'Retrieved Successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30|min:4',
            'username' => 'required|string|max:25|min:3',
            'role' => 'required|string|in:admin,backoffice,regular',
            'password' => 'required|string|max:30|min:8'
        ]);
        
        if ($validator->fails())
        {
            return response(['errors' => $validator->errors()->all()], 401);
        }

        $name = $request->input('name');
        $username = $request->input('username');
        $role = $request->input('role');
        $password = bcrypt($request->input('password'));

        $newUser = User::create([
            'name' => $name,
            'username' => $username,
            'role' => $role,
            'password' => $password
        ]);

        return response(['user' => new UserResource($newUser), 'status' => 'Created'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response(['user' => new UserResource($user), 'status' => 'Retrieved successfully'], 200);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function getBearerToken (Request $request) 
    {
        return response(['bearerToken' => $request->bearerToken()]);
    }

    public function getAuthenticatedUser (Request $request)
    {
        return $request->user()->name;
    }

    public function getUserId()
    {
        return response(['user_id' => Auth::guard('api')->user()->id], 200);
    }
}

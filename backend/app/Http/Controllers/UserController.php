<?php

namespace App\Http\Controllers;

use App\Enums\UserTypes;
use App\Models\User;
use App\Traits\BasicResponseTrait;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use BasicResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'per_page' => 'integer',
        ]);

        $per_page = request('per_page', 10);
        return $this->successResponse(User::paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'user_type' => 'in:'.implode(',',UserTypes::values()),
            'name' => 'required|string|unique:users,name|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|confirmed|max:255',
        ]);

        return $this->successResponse(
            User::create(
                array_merge(
                    request(['user_type', 'name', 'email']),
                    ['password' => Hash::make(request('password'))]
                )
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->successResponse(User::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        request()->validate([
            'user_type' => 'in:'.implode(',',UserTypes::values()),
            'name' => 'required|string|unique:users,name,'.$id.'|max:255',
            'email' => 'required|email|unique:users,email,'.$id.'|max:255',
            'password' => 'required|string|confirmed|max:255',
        ]);

        return $this->successResponse(
            User::where('id', $id)->update(
                array_merge(
                    request(['user_type', 'name', 'email']),
                    ['password' => Hash::make(request('password'))]
                )
            ) ? User::find($id) : $this->errorResponse([])
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->successResponse([]);
    }
}

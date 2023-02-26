<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json([
            'status' => 'success',
            'roles' => $roles
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\jsonResponse
     */
    public function store(Request $request)
    {
        $role = Role::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Role added successfully!',
            'role' => $role

        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\jsonResponse
     */
    public function show(Role $role)
    {
        $role->find($role->id);
        if(!$role){
            return response()->json(['message' => 'This role doesn\'t exist!']);
        }
        return response()->json($role, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\jsonResponse
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Role updated successfully!',
            'role' => $role,
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\jsonResponse
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json([
            'status' => true,
            'message' => 'Role deleted successfully!',
        ], 200);
    }
}
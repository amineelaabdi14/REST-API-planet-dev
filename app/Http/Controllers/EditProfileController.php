<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class EditProfileController extends Controller
{
    //
    
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function editInfos(Request $req)
    {
        $user = User::Find($req->id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=$req->password;
        $user->save();
        return response()->json([
            'status' => true,
            'message' => "Profile Updated successfully!",
            'article' => $user
        ], 200);
    }
}

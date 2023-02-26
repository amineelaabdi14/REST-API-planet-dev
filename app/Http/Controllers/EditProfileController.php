<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Hash;

class EditProfileController extends Controller
{
    //
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function editInfos(Request $req,User $user)
    {
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        if(!Hash::check($req->password,$user->password)){
            return response()->json(['message' => 'incorrect password'], 404);
        }
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password= Hash::make($req->newPassword);
        $user->save();
        return response()->json([
            'status' => true,
            'message' => "Profile Updated successfully!",
            'article' => $user
        ], 200);
    }
}

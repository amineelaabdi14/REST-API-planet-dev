<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Mail\SendMailReset;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    // this is most important function to send mail and inside of that there are another function
    public function sendEmail(Request $request)
    {
        // this is validate to fail send mail or true
        if (!$this->validateEmail($request->email)) {
            return $this->failedResponse();
        }
        //this is a function to send mail 
        $this->send($request->email);
        return $this->successResponse();
    }

    //this is a function to send mail
    public function send($email) 
    {
        $token = $this->createToken($email);
        // token is important in send mail 
        Mail::to($email)->send(new SendMailReset($token, $email));
    }

    // this is a function to get your request email that there are or not to send mail
    public function createToken($email)
    {
        $oldToken = DB::table('password_resets')->where('email', $email)->first();

        if ($oldToken) {
            return $oldToken->token;
        }

        $token = Str::random(40);
        $this->saveToken($token, $email);
        return $token;
    }

    // this function save new password
    public function saveToken($token, $email)
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }

    //this is a function to get your email from database
    public function validateEmail($email)
    {
        return !!User::where('email', $email)->first();
    }

    public function failedResponse()
    {
        return response()->json([
            'error' => 'Email does\'t found on our database'
        ], Response::HTTP_NOT_FOUND);
    }

    public function successResponse()
    {
        return response()->json([
            'data' => 'Reset Email is send successfully, please check your inbox.'
        ], Response::HTTP_OK);
    }
}

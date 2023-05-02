<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Mail\OtpMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;


class AuthController extends Controller
{
    public function createAdmin(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|unique:users,email|unique:admins,email',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $admin = Admin::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'password_confirmation' => Hash::make($request->input('password_confirmation')),
        ]);


        if($admin){

            $token = $admin->createToken('admin_token')->plainTextToken;
            $admin['token'] = $token;

            return response()->json(
                [
                    'code'=> 200,
                    'success' => true,
                    'message' => 'Admin was created successfully',
                    'data' => $admin
                ]
            );
        }

        return response()->json(
            [
                'code'=> 500,
                'success' => false,
                'message' => 'Oh ooh! Action Failed, Something wrong on the server end.',
            ]
        );
    }
    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            $token = $admin->createToken('auth_token')->plainTextToken;

            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'Login successful',
                'data' => [
                    'admin' => $admin,
                    'token' => $token,
                ],
            ]);
        }

        return response()->json([
            'code' => 401,
            'success' => false,
            'message' => 'Invalid credentials',
        ]);

    }


    public function generateInvitationKey(){
        $user_id = auth()->id();
        $code = rand(100000, 999999);

        $invitationKey = DB::table('invitation_codes')->insert([
            'user_id' => auth()->id(),
            'invitation_code' => $code
        ]);

        if($invitationKey){
            return response()->json(
                [
                    'code'=> 200,
                    'success' => true,
                    'message' => 'Invitation Key was generated Successfully',
                    'data' => $code
                ]
            );
        }

        return response()->json(
            [
                'code'=> 500,
                'success' => false,
                'message' => 'Oh ooh! Action Failed, Something wrong on the server end.',
            ]
        );
    }

    public function sendOtp(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:phone',
            'phone' => 'required_without:email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $client = new Client(
    env('TWILIO_ACCOUNT_SID'),
    env('TWILIO_AUTH_TOKEN')
);

        $otp = rand(1000, 9999);

        if($request->input('email')){
            $user = User::where('email', $request->input('email'))->first();
            
        }

        else{
            $user = User::where('phone', $request->input('phone'))->first();
            $toNumber = $request->input('phone');
            $message = 'Your verification code is: 1234';

            $client->messages->create($toNumber, [
                'from' => env('TWILIO_NUMBER'),
                'body' => $message
            ]);
        }

        if(!$user){
            $user = new User;
        }

        if($request->email){
            $user->email = $request->email;
        }
        if($request->phone){
            $user->phone = $request->phone;
        }

        $user->otp = $otp;
        $user->save();

        $to = $request->email ?? $request->phone;
        Mail::to($to)->send(new OtpMail($otp));

        return response()->json(['code' => 200, 'otp' => $otp, 'email' => $request->input('email')]);
    }

    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:phone',
            'phone' => 'required_without:email',
            'otp' => 'required|integer',
            'password' => 'required|confirmed',
            'invitation_code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $user = User::where('email', $request->input('email'))->where('phone', $request->input('phone'))->first();

        if ($user->otp != (int)$request->otp) {
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'Incorrect OTP',
            ]);
        }

        $get_invitation = DB::table('invitation_codes')->where('invitation_code', $request->input('invitation_code'))->first();
        if(!$get_invitation){
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'Incorrect Invitation Code'
            ]);
        }

        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->invitation_code = $request->invitation_code;
        $user->save();

        if($user){
            $token = $user->createToken('user_token')->plainTextToken;
            $user['token'] = $token;
            $user_id = $user->id;
            $code = rand(100000, 999999);

            $user->invitation_code = $code;

            $invitationKey = DB::table('invitation_codes')->insert([
                'user_id' => $user_id,
                'invitation_code' => $code
            ]);

            if($invitationKey){
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'User Created',
                    'token' => $user['token'],
                    'invitation_code' => $code
                ]);
            }
        }
    }

    public function userLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:phone|email',
            'phone' => 'required_without:email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        if(!$request->phone){
            $user = User::where('email', $request->email)->first();
        }

        if($request->phone){
            $user = User::where('phone', $request->phone)->first();
        }

        if(!$user->password){
            return response()->json(['code' => 401, 'success' => false, 'message' => 'Your registration was not completed the last time']);
        }

        if ($user) {
            $token = $user->createToken('user_token')->plainTextToken;
            $user['token'] = $token;
            if (Hash::check($request->password, $user->password)) {
                $get_invitation = DB::table('invitation_codes')->where('user_id', $user->id)->first();
                if($get_invitation){
                    return response()->json([
                        'code' => 200,
                        'success' => true,
                        'message' => 'User logged in',
                        'token' => $user['token'],
                        'invitation_code' => $user['invitation_code'],
                        'profile_picture' => $user['profile_picture'],
                    ]);
                }
            } else {
                return response()->json(['code' => 401, 'success' => false, 'message' => 'Password mismatch']);
            }
        } else {
            return response()->json(['code' => 404, 'success' => false, 'message' => 'User does not exist']);
        }
    }

    public function generateOtp(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:phone',
            'phone' => 'required_without:email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $otp = rand(1000, 9999);

        if($request->input('email')){
            $user = User::where('email', $request->input('email'))->first();
            
        }

        else{
            $user = User::where('phone', $request->input('phone'))->first();
        }


        // dd($user);
        if(!$user){
            return response()->json(['code' => 404, 'success' => false, 'message' => 'User not found']);
        }

        $to = $user->email ?? $user->phone;
        
        
        $mail = Mail::to($to)->send(new OtpMail($otp));

        $user->otp = $otp;
        $user->save();
        return response()->json(['code' => 200, 'otp' => $otp]);
        // if($mail){
        // }


    }


    public function verifyOtpAndChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:phone',
            'phone' => 'required_without:email',
            'otp' => 'required|integer',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        if($request->input('email')){
            $user = User::where('email', $request->input('email'))->first();
        }

        else{
            $user = User::where('phone', $request->input('phone'))->first();
        }

        // dd($user);

        if(!$user){
            return response()->json(['code' => 404, 'success' => false, 'message' => 'User not found']);
        }

        if ($user->otp != (int)$request->otp) {
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'Incorrect OTP',
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->save();

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Password changed successfully'
        ]);
    }


}

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
        $otp = rand(1000, 9999);

        if($request->input('email')){
            $user = User::where('email', $request->input('email'))->first();
            if(!$user){
                $user = new User;
            }
        }




        if($request->email){
            $user->email = $request->email;

            $to = $request->email ?? $request->phone;
            Mail::to($to)->send(new OtpMail($otp));
        }

        // if($request->phone){
        //     $user = User::where('phone', $request->input('phone'))->first();
        //     if(!$user){
        //         $user = new User;
        //     }
        //     $user->phone = $request->phone;

        //     $token = getenv("TWILIO_AUTH_TOKEN");
        //     $twilio_sid = getenv("TWILIO_ACCOUNT_SID");
        //     $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");

        //     \Log::info("TWILIO_SID: {$twilio_sid}, TWILIO_AUTH_TOKEN: {$token}, TWILIO_VERIFY_SID: {$twilio_verify_sid}");

        //     $twilio = new Client($twilio_sid, $token);

        //     // Send OTP to the user
        //     $verification = $twilio->verify->v2->services($twilio_verify_sid)
        //                     ->verifications
        //                     ->create($request->phone, "sms");

        //     // Store the verification SID to retrieve the status later
        //     $user->verification_sid = $verification->sid;


        // }

        $user->otp = $otp;
        $user->save();

        $mail = $request->email ?? $request->phone;
        
        return response()->json(['code' => 200, 'otp' => $otp, 'mail' => $mail]);
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


        // return $user;

        if($request->phone){

            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_ACCOUNT_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");

            \Log::info("TWILIO_SID: {$twilio_sid}, TWILIO_AUTH_TOKEN: {$token}, TWILIO_VERIFY_SID: {$twilio_verify_sid}");

            $twilio = new Client($twilio_sid, $token);

            // Retrieve the OTP status for a given verification SID
            $verification_check = $twilio->verify->v2->services($twilio_verify_sid)
                                    ->verificationChecks
                                    ->create(['to' => $request['phone'], 'code' => $request['otp']]);

            // return $verification_check;
            // Check the status of the verification check
            if ($verification_check->status == "approved") {
                $request->otp = $user->otp;
            } else {
                return response()->json([
                    'code' => 404,
                    'success' => false,
                    'message' => 'Incorrect OTP',
                ]);
            }
        }

        if ($user->otp != (int)$request->otp) {
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'Incorrect OTP',
            ]);
        }   

        if($user->password){
            return response()->json(['code' => 500, 'message' => 'User already registered']);
        }

        $get_invitation = DB::table('invitation_codes')->where('invitation_code', $request->invitation_code)->latest()->first();
        // $get_invitation = DB::table('users')->where('email', 'broufrahetoubou-3139@yopmail.com')->get();

        // return $get_invitation;
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
            $user_id = $user->id;
            // Generate a unique invitation code
            $uniqueCode = false;
            while (!$uniqueCode) {
                $code = rand(100000, 999999);

                // Check if the code already exists in the database
                $codeExists = DB::table('invitation_codes')->where('invitation_code', $code)->exists();

                if (!$codeExists) {
                    $uniqueCode = true;
                }   
            }

            // Insert the code into the database
            $invitationKey = DB::table('invitation_codes')->insert([
                'user_id' => $user_id,
                'invitation_code' => $code
            ]);


            if($invitationKey){
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'User Created',
                    'token' => $token,
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
                $get_invitation = DB::table('invitation_codes')->where('user_id', $user->id)->latest()->first();

                // return $get_invitation;
                if($get_invitation){
                    return response()->json([
                        'code' => 200,
                        'success' => true,
                        'message' => 'User logged in',
                        'token' => $user['token'],
                        'invitation_code' => $get_invitation->invitation_code,
                        'profile_picture' => $user['profile_picture'],
                        'wallet_address' => $user['wallet_address'],
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

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Hash;
use DB;

class AuthController extends Controller
{
    // public function login(Request $r){
    //     $validator = Validator::make($r->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);
    //     if($validator->fails()){
    //         return response()->json([
    //             'status' => 'is_valid',
    //             'errors' => $validator->errors(),
    //             'sms' => '<div class="text-danger">សូមបញ្ចូលអ៊ីម៉ែល និង លេខសម្ងាត់!!! </div>'
    //         ]);
    //     }
    //     $user = User::where(['email' => $r->email])->first();
    //     if($user){
    //         if(Hash::check($r->password, $user->password)){
    //             if($user->is_two_factor == 1){
    //                 $num_str = sprintf("%06d", mt_rand(1, 999999));
    //                 $user = User::find($user->id);
    //                 $user->otp = $num_str;
    //                 $user->save();
    //                 return response()->json(['status' => 'is_two_factor', 'sms' => __('OTP Sent'), 'user_id' => base64Encode($user->id)]);
    //             } else {

    //                 DB::table('users')->where('id',$user->id)->update([
    //                     'lat' => $r->lat,
    //                     'lng' => $r->lng
    //                 ]);
    //                 $token = $user->createToken('MyApi')->accessToken;
    //                 return $this->shareData(['status' => 'success', 'sms' => __('Login Successfully'), 'data' => [
    //                     'user' => $user,
    //                     'token' => $token
    //                 ]], $user->id);
    //             }
    //         }
    //         return response()->json(['status' => 'error', 'sms' => 'Password not match !!!']);
    //     }
    //     return response()->json(['status' => 'error', 'sms' => 'User not found !!!']);
    // }
    public function login(Request $request){
        $valilator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($valilator->fails()){
            return response()->json([
                'data' => 'error',
                'status' => '<div class="text-danger">errors</div>',
                'sms' => '<div class="text-danger">សូមបំពេញអាសយដ្ឋាន និងពាក្យសម្ងាត់!<div>'
            ]);
        }

        $user = User::where('email', $request->email)->first();
        if(!User::where('email', $request->email)->count()){
            return response()->json([
                'data' => 'error',
                'status' => 'error',
                'sms' => 'សូមបំពេញអាសយដ្ឋានឲ្យបានត្រឹមត្រូវ!'
            ]);
        }elseif($user->active == 0){
            return response()->json([
                'data' => 'error',
                'status' => 'error',
                'sms' => 'អាសយដ្ឋានរបស់អ្នកត្រូវបានបិទ!'
            ]);
        }elseif(!Hash::check($request->password, $user->password)){
            return response()->json([
                'data' => 'error',
                'status' => 'error',
                'sms' => 'សូមបំពេញពាក្យសម្ងាត់ឲ្យបានត្រឹមត្រូវ!'
            ]);
        }else{
            $attempt_data = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            if(auth()->attempt($attempt_data)){

                $auth = auth()->user()->createToken('Secret');
                $token = $auth->accessToken;
                return response()->json([
                    'data' => ['user_data' => auth()->user(), 'token' => $token],
                    'status' => 'success',
                    'sms' => 'ចូលប្រើប្រាស់ប្រព័ន្ធ បានជោគជ័យ!'
                ]);
            }else{
                return response()->json([
                    'data' => 'error',
                    'status' => 'error',
                    'sms' => 'សូមបំពេញអាសយដ្ឋាន និងពាក្យសម្ងាត់!'
                ]);
            }
           
        }
    }
    public function logout(Request $r){
        $r->user()->token()->revoke();
        // audit('is_logout','is_view',$r->user());
        return response()->json(['status' => 'success', 'sms' => __('ចាកចេញបានជោគជ័យ!!!')]);
    }
    public function checkOTP(Request $r){
        $user = User::find($r->user_id);
        if($user){
            if($user->otp == $r->otp){
                $token = $user->createToken('MyApi')->accessToken;
                return response()->json(['status' => 'success', 'sms' => __('Login Successfully'), 'data' => [
                    'user' => $user,
                    'token' => $token
                ]]);
            } else {
                return response()->json(['status' => 'error', 'sms' => 'Wrong OTP !!!']);
            }
        }
        return response()->json(['status' => 'error', 'sms' => 'Somethings Wrong !!!']);
    }
}
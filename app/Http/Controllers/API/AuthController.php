<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3'
        ],[
            'name.required' => 'ป้อนข้อมูลชื่อด้วย',
            'email.required' => 'ป้อนข้อมูลอีเมล์ด้วย',
            'email.email' => 'รูปแบบอีเมล์ไม่ถูกต้อง',
            'email.unique' => 'มีผู้ใช้งานอีเมล์นี้ในระบบแล้ว',
            'password.required' => 'ป้อนข้อมูลรหัสผ่านด้วย',
            'password.min' => 'ป้อนข้อมูลรหัสผ่านอย่างน้อย 3 ตัวอักษร',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => [
                    'message' => $validator->errors()
                ]
            ], 422);
        }

       //เพิ่ม user ใหม่
       $user = new User();
       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = Hash::make($request->password); 
       $user->save();

       return response()->json([
           'message' => 'สมัครสมาชิกสำเร็จ'
       ], 201);

        return 'register';
    }

    public function login(){
        return 'login';
    }

    public function logout(){
        return 'logout';
    }
}

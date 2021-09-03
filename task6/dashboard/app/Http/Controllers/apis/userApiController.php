<?php

namespace App\Http\Controllers\apis;

use App\Models\User;
use App\traits\generalTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;



class userApiController extends Controller
{
    use generalTrait;

    public function register(Request $request)
    {

        $rules = [
            'name' => ['required', 'string', 'max:30'],
            'phone' => ['required', 'unique:users', 'numeric', 'digits:11'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnValidationError($validator);
        }

        $data = $validator->safe()->except(['password']);
        $data['password'] = Hash::make($request->password);
        $credentials = $validator->safe()->only(['email', 'password']);

        $user = User::create($data);
        $token = auth('api')->attempt($credentials);

        return $this->returnUserWithToken($user, 'bearer ' . $token);
    }

    public function sendCode(Request $request)
    {
        $token = $request->header('Authorization');
        $user = Auth::guard('api')->user();
        $code = rand(10000, 99999);
        $user->code = $code;
        $user->save();
        return $this->returnUserWithToken($user, $token);
    }


    public function verifyCode(Request $request)
    {
        $user = Auth::guard('api')->user();

        $token = $request->header('Authorization');

        $rules = [
            'code' => ['required', 'integer', 'digits:5', 'exists:users'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnValidationError($validator);
        }

        $verifyCodeResult = User::where('email', $user->email)->where('code', $request->code)->first();
        if ($verifyCodeResult) {
            $verifyCodeResult->email_verified_at = date('Y-m-d H:i:s');
            $verifyCodeResult->save();
            return $this->returnUserWithToken($verifyCodeResult, $token);
        } else {
            return $this->returnErrorMessage(null, 'Wrong Code');
        }
    }


    public function login(Request $request)
    {
        $rules = [
            'email' => ['required', 'exists:users', 'email'],
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/']
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnValidationError($validator);
        }
        $credentials = $validator->safe()->only(['email', 'password']);
        $token = auth('api')->attempt($credentials);
        if ($token) {
            $user = Auth::guard('api')->user();
            if ($user->email_verified_at) {
                return $this->returnUserWithToken($user, 'bearer ' . $token);
            } else {
                return $this->returnUserWithToken($user, 'bearer ' . $token, "User Not Verified", 401);
            }
        } else {
            return $this->returnErrorMessage(null, 'Wrong Eamil Or Password');
        }
    }


    public function logout(Request $request)
    {
        Auth::guard('api')->logout();
        return $this->returnSuccessMessage('You Have Successfully Logged Out');
    }

    public function profile(Request $request)
    {
        $user = Auth::guard('api')->user();
        $token = $request->header('Authorization');
        return $this->returnUserWithToken($user, $token);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::guard('api')->user();
        $rules = [
            'name' => ['required', 'string', 'max:30'],
            'phone' => ['required', "unique:users,phone,$user->id,id", 'numeric', 'digits:11'],
            'image' => ['nullable', 'mimes:jpg,png', 'max:1000', 'image'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnValidationError($validator);
        }

        $data = $validator->safe()->except('image');
        if ($request->has('image')) {
            $photoName = $this->uploadPhoto($request->image, 'users');
            $data['image'] = $photoName;
            $this->deletePhoto('users', $user->id);
        }

        $user->update($data);
        $token = $request->header('Authorization');
        return $this->returnUserWithToken($user, $token);
    }
}
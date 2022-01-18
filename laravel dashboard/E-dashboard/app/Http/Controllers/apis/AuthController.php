<?php

namespace App\Http\Controllers\apis;

use App\Models\User;
use App\traits\generalTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use generalTraits;

    public function login(Request $request){
          $this->credentialsValidation($request);
          $credentials = $request->only('password','email');
          if (! $token = auth('api')->attempt($credentials)) {
              return $this->returnErrorMessage(NULL,"Wrong Email Or Password");
          }
          $user = auth('api')->user();
          if(!$user->email_verified_at){
              return $this->returnUserWithToken($user,'bearer '.$token,"Email Not Verified",403);
          }
          return $this->returnUserWithToken($user,'bearer '.$token);
  
      }

    
    public function register(Request $request){

        $rules = [
            'name'=>['required','string'],
            'email'=>'required|email|unique:users',
            'phone'=>'required|string|digits:11|unique:users',
            'password'=>'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->returnValidationError($validator);
        }

        $data = $request->except('password');
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $credentials = $request->only('email','password');
        $token = auth('api')-> attempt ($credentials); 
        return $this->returnUserWithToken($user,'bearer '.$token);
        
    }
    public function sendCode(Request $request)
    {
        $user =  auth('api')->user();
        $token = $request->header('Authorization');
        $userDB = User::find($user->id);
        if($this->updateCode($userDB)){
            return $this->returnUserWithToken($userDB,$token);
        }else{
            return $this->returnErrorMessage(NULL,'Something Went Wrong',500);
        }
    }
    public function verifyCode(Request $request)
    {
        $user = auth('api')->user();
        $token = $request->header('Authorization');
        $userDB = User::find($user->id);
        if($this->checkCode($userDB,$request->code)){
            return $this->returnUserWithToken($userDB,$token,'Correct Code');
        }else{
            return $this->returnUserWithToken($userDB,$token,'Wrong Code',403);
        }

    }
    public function profile(Request $request)
    {
       $user = User::find(auth('api')->id());
       $token = $request->header('Authorization');
       return $this->returnUserWithToken($user,$token);
    }
    public function sendCodeForget(Request $request)
    {
        
        $user = $this->getUserFromEmail($request->email);
        if($this->updateCode($user)){
            return $this->returnData('user',$user,'Code Sent Successfully');
        }else{
            return $this->returnErrorMessage(NULL,'Something Went Wrong',500);
        }

    }

    public function verifyCodeForget(Request $request)
    {
        // get user from mail
        $user = $this->getUserFromEmail($request->email);
        if($this->checkCode($user,$request->code)){
           return $this->returnData('user',$user,'Correct Code');
        }else{
            return  $this->returnData('user',$user,'Wrong Code',403);
        }
    }

    public function setNewPassword(Request $request)
    {
        $this->credentialsValidation($request);
        User::where('email',$request->email)->update(['password'=>Hash::make($request->password)]);
        $token = auth('api')->attempt($request->only('email','password'));
        $user = auth('api')->user();
        return $this->returnUserWithToken($user,'bearer '.$token);
    }

    public function logout()
    {
       auth('api')-> logout() ;
       return $this->returnSuccessMessage('You Have Successfully Logged Out');
    }

    public function getUserFromEmail($email)
    {
        $rules = [
            'email'=>'required|email|exists:users',
        ];
        $validator = Validator::make(['email'=>$email],$rules);
        if($validator->fails()){
            return $this->returnValidationError($validator);
        }
        return User::where('email',$email)->first();

    }

    public function credentialsValidation($request)
    {
        $rules = [
            'email'=>'required|email',
            'password'=>'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->returnValidationError($validator);
        }
        return true;
    }

    public function updateCode(object $user)
    {
        $code = rand(10000,99999);
        $user->code = $code;
        $user->save();
         // send code
        return true;
    }
    public function checkCode($user,$code)
    {
        if($user->code == $code){
            if(!$user->email_verified_at){
                $email_verified_at = date('Y-m-d H:i:s');
                $user->email_verified_at = $email_verified_at;
                $user->save();
            }
            return true;
        }else{
            return false;
        }
    }
   
}

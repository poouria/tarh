<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\ResError;
use App\Http\Resources\ResUser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class RegisterController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'avatar' => 'mimes:jpeg,jpg,JPG,png|max:3000',
            'status' => 'boolean',
        ]);
        if ($validator->fails()){
            return new ResError(['error' => $validator->errors(), 'status' => 400]);
        }

        if ($request->status == '1'){
            $request['status']= 1;
        }
        else if ($request->status == '0'){
            $request['status']= 0;
        }else{
            $request['status']= 1;
        }

        $avatarName= Uuid::generate()->string;
        if( $request->avatar !=null){
            $avatar=$request->file('avatar');
            $ext = $request->file('avatar')->extension();
            $avatarName = $avatarName . '.' .$ext ;
            $avatar->move('images/users/avatars',$avatarName);
        }
        try {
            $user = new User([
                'email' => $request->email,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'avatar' => $avatarName,
                'status' => $request->status,
            ]);
            $user->save();

        } catch(\Illuminate\Database\QueryException $ex){
            if (public_path() . env("USER_AVATAR_URL") . $avatarName){
                unlink(public_path() . env("USER_AVATAR_URL") . $avatarName);
            }
            return new ResError(['error' => 'خطا در ثبت اطلاعات', 'status' => 500]);
        }
        return new ResUser(User::find($user->id));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Signup;
class SignupController extends Controller
{
    public function saveUser(Request $request){
       $user=new Signup;
       $name=$request->input('name');
       $n1=strtoupper($name);
       $n2=substr($n1,0,2);
       $userid=$n2.mt_rand(100000,999999);
       $user->user_id=$userid;
       $user->user_name=$name;
       $user->password=$request->input('password');
       $user->save();
        $msg='User registered successfully';
        return response()->json(['msg'=>$msg]);
    }

    public function checkUser(Request $request){
        $users=Signup::all();
          $name=$request->input('name');
          $pass=$request->input('password');
          $flag=0;
          if(count($users)>0){
      foreach($users as $user){
        if($user->user_name==$name && $user->password==$pass )
        {
          session(['loggedinuser'=>$user->user_name]);
          session(['userid'=>$user->user_id]);
          $flag=1;
          break;
        }
       }
    }
    if($flag==0){
    $msg="0";
  }else{
      $msg="1";
  }
    return response()->json(['msg'=>$msg]);

    }


    public function logout(Request $request){
    session()->forget('loggedinuser');
    session()->forget('userid');
    return view('layouts.login');
  }
}

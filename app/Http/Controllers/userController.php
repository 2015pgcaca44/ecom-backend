<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

class userController extends Controller
{ 
    function users() {
        
        $user = User::get();
        return $user;
    }
    function login(Request $request) { 
        $validator = Validator::make($request->all(), [
            'email' => 'required|email', 
            'pass' => 'required',  
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $email = $request->input("email");
        $password = $request->input("pass");
        $user = User::where('email',$email)->where('password',$password)->get();
        if(count($user) > 0)
        {
            return \Response::json(['message'=>'success', 'data' => $user], 200);
        }else{
            return \Response::json(['message' => 'invalid credentials']);
        }
    }
    function register(Request $request) { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'pass' => 'required',  
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = $request->input("pass");
        $user->save();
        return $user;
    }
    function delete($id){
        $user = User::find($id);
        $user->delete();
        return \Response::json(['message'=>'deleted success'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\roles;
use App\Models\users;
class logincontroller extends Controller
{
    


    public function login(Request $request){

    	$login = users::where('email','=',$request->get('email'))->where('password','=',$request->get('password'))->get();


    	if(count($login)){
    	
           

            Session::put('fullname',$login[0]->Name);
            Session::put('userid',$login[0]->user_id);
            Session::put('role',$login[0]->roles->displayname);

            if($login[0]->role_id == 1){

                 Session::put('admin',1);
            	return redirect('/roles')->with('message', 'Successfully');
                
            }
            else{
                Session::put('user',1);
            	return redirect('/userchart')->with('message', 'Successfully');
            }


    	}
    	else{
    		return redirect('/')->with('error', 'Wrong Credentials');
    	}

    }

    public function logout(){

		Session::flush();
		return redirect('/');	
	}
}

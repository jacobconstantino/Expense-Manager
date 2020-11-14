<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\roles;
use App\Models\users;
use App\Models\expense;
use App\Models\category_expense;
class usercontroller extends Controller
{
     public function userlayout(){

    	return view('masterlayout.userlayout');
    }
    public function usermanagement(){

    	return view('user.usermanagement');
    }
    public function expenses(){
       $user_id = session()->get('userid');

        $category = category_expense::orderBy('category_id','desc')->get();
    	$expenses = expense::with('category')->orderBy('expense_id','desc')->where('user_id','=',$user_id)->get();

    	return view('user.expenses',compact('expenses','category'));
    }

    public function usernewexpense(Request $request){
       $this->validate($request,[


      ]);
       $user_id = session()->get('userid');

        $now = date('Y-m-d H:i');
        $now = $request->request->get('date');

       $expenses = expense::firstOrCreate([
        'category_id' => $request->get('category'),
        'user_id' => $user_id,
        'amount' => $request->get('amount'),
        'entry' => $now,


       ]);

       $expenses->save();


       return redirect('/userexpenses')->with('message', 'Successfully Added');

    }
     public function userdeleteexpense($id){
    $user_id = session()->get('userid');
    $delete = expense::where([['expense_id','=',$id],['user_id','=',$user_id]])->first();

    $delete->delete();
     

      return redirect('/userexpenses')->with('message', 'Successfully Deleted');

    }


    public function userupdateexpense(Request $request){
        $id =  $request->get('expense_id');
        $user_id = session()->get('userid');
   

      $expense = expense::where([['expense_id','=',$id],['user_id','=',$user_id]])->first();

      $expense->category_id = $request->get('category');
      $expense->amount = $request->get('amount');
      $expense->entry = $request->get('date');

      $expense->update();

      return redirect('/userexpenses')->with('message', 'Successfully Update');
    }


    public function changepassword(Request $request){
      $this->validate($request,[

      ]);
    $user_id = session()->get('userid');
    $users = users::find($user_id);

    $currentpassword = $users->password;
    $oldpassword = $request->get('oldpassword');
    $newpassword = $request->get('newpassword');
    $confirmpassword = $request->get('confirmpassword');
    if($currentpassword == $oldpassword){
      if($newpassword == $confirmpassword){

        $users->password = $confirmpassword;

        $users->save();
        
        return redirect('/usermanagement')->with('message', 'Successfully Updated');
      }
      else{
      
               return redirect('/usermanagement')->with('error', 'New password And Confirm password Not match!');
      }
    }
    else{
      
            return redirect('/usermanagement')->with('error', 'Incorrect Old Password ');
    
    }
  }

   public function chart(){

      $user_id = session()->get('userid');
      
      $expense = expense::distinct()->select('category_id')->get();
      $category = expense::select('category_id',\DB::raw('SUM(amount) as total_amount'))->whereIn('category_id',$expense)->where('user_id','=',$user_id)
      ->groupBy('category_id')->orderBy('category_id')->get();


      
        return view('user.chart',compact('category'));
    }

   
}
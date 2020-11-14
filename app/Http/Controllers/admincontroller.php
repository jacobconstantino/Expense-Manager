<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\roles;
use App\Models\users;
use App\Models\expense;
use App\Models\category_expense;

class admincontroller extends Controller
{
  	
  	public function roles(){

      $roles = roles::orderBy('role_id','desc')->get();
  		return view('admin.roles',compact('roles'));
  	}

  	public function user(){

      $roles = roles::orderBy('role_id','desc')->get();
      $users = users::with('roles')->orderBy('user_id','desc')->get();
  		return view('admin.user',compact('roles','users'));
  	}

  	public function expenses(){
      $category = category_expense::orderBy('category_id','desc')->get();

      $expenses = expense::with('category')->orderBy('expense_id','desc')->get();
  		return view('admin.expenses',compact('category','expenses'));
  	}

  	public function category_expense(){

      $category = category_expense::orderBy('category_id','desc')->get();


  		return view('admin.expense_categories',compact('category'));
  	}

    public function newrole(Request $request){
      $this->validate($request,[

      ]);

      $roles = roles::firstOrCreate([
        'displayname' => $request->get('displayname'),
        'description' => $request->get('description')
      ]);

      $roles->save();

      return redirect('/roles')->with('message', 'Successfully Added');
    }

    public function newuser(Request $request){
      $this->validate($request,[


      ]);

      $password = 123;
      $user = users::firstOrCreate([
        'Name' => $request->get('name'),
        'Email' => $request->get('email'),
        'password' => $password,
        'role_id' => $request->get('role')

      ]);

      $user->save();

      return redirect('/user')->with('message', 'Successfully Added');

    }


    public function newcategory(Request $request){
       $this->validate($request,[


      ]);


       $category = category_expense::firstOrCreate([
        'name' => $request->get('name'),
        'description' => $request->get('description')

       ]);

       $category->save();

       return redirect('/categoryexpense')->with('message', 'Successfully Added');

    }

    public function newexpense(Request $request){
       $this->validate($request,[


      ]);

        $now = date('Y-m-d H:i');
        $now = $request->request->get('date');
        $user_id = session()->get('userid');
       $expenses = expense::firstOrCreate([
        'category_id' => $request->get('category'),
        'user_id' => $user_id,
        'amount' => $request->get('amount'),
        'entry' => $now,


       ]);

       $expenses->save();


       return redirect('/expenses')->with('message', 'Successfully Added');

    }

    public function updaterole(Request $request){
      $this->validate($request,[


      ]);

      $role = roles::find($request->get('role_id'));

      $role->displayname = $request->get('displayname');
      $role->description = $request->get('description');


      $role->update();


      return redirect('/roles')->with('message', 'Successfully Update');
    }

    public function deleterole($id){

      $role = roles::find($id);


      $role->delete();


      return redirect('/roles')->with('message', 'Successfully Deleted');
    }

    public function updateuser(Request $request){

      $role = $request->get('role');
     
      $user = users::find($request->get('user_id'));


      $user->name = $request->get('name');
      $user->email = $request->get('email');
      $user->role_id = $request->get('role');


      $user->update();


       return redirect('/user')->with('message', 'Successfully Update');  
    }

    public function deleteuser($id){

      $users = users::find($id);


      $users->delete();

       return redirect('/user')->with('message', 'Successfully Deleted');  
    }

    public function updatecategory(Request $request){

      $category = category_expense::find($request->get('user_id'));

      $category->name = $request->get('name');
      $category->description = $request->get('description');


      $category->save();


      return redirect('/categoryexpense')->with('message', 'Successfully Update');
    }

    public function deletecategory($id){

      $category = category_expense::find($id);

      $category->delete();

      return redirect('/categoryexpense');
    }

    public function updateexpenses(Request $request){

      $expense = expense::find($request->get('expense_id'));

      $expense->category_id = $request->get('category');
      $expense->amount = $request->get('amount');
      $expense->entry = $request->get('date');

      $expense->update();

       return redirect('/expenses')->with('message', 'Successfully Update');
    }

    public function deleteexpense($id){

      $expense = expense::find($id);

      $expense->delete();

      return redirect('/expenses')->with('message', 'Successfully Deleted');

    }

    public function chart(){

      $user_id = session()->get('userid');
      
      $expense = expense::distinct()->select('category_id')->get();
      $category = expense::select('category_id',\DB::raw('SUM(amount) as total_amount'))->whereIn('category_id',$expense)->where('user_id','=',$user_id)
      ->groupBy('category_id')->orderBy('category_id')->get();


      
        return view('admin.chart',compact('category'));
    }
    
}

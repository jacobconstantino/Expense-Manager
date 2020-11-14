@extends('masterlayout.userlayout')

@section('content')

<style type="text/css">

.maincontent{
  margin:auto;
  align-content: center;  
}
.forms{
 margin-left: 170px;
}
</style>

<div >
<label style="font-size:20px"><b>Change Password </b></label>
<label style="float:right;">User Management </label>	
</div>
        @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif


<div class="maincontent">
  <div class="forms">
<form method="post" action="/userchangepassword">

        
          <fieldset class="scheduler-border">
            
                 <div class="row">
                  <div class="col-md-8">
                 <label>Old Password</label>
                 <input type="password" name="oldpassword" class="form-control">
               </div>
                 </div>
                 <div class="row">
                     <div class="col-md-8">
                 <label>New Password</label>
                 <input type="password" name="newpassword" class="form-control">
                 </div></div>
                 <div class="row">
                     <div class="col-md-8">
                 <label>Confirm Password</label>
                 <input type="password" name="confirmpassword" class="form-control">
                     </div></div>
              
                 @csrf
                 </div>
                   <button  type="submit" class="btn btn-primary ml-2" style="width: 95%; margin-top: 15px;" > Update</button>
                 </fieldset>
               </form>
  

</div>






@endsection
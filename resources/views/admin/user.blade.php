@extends('masterlayout.adminlayout')

@section('content')

<style type="text/css">
	
</style>

<div >
<label style="font-size:20px"><b>Users </b></label>
<label style="float:right;">User Management > Users</label>	
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
<div>
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email Address</th>
      <th scope="col">Role</th>
      <th>Created_at</th>
     
    </tr>
  </thead>
  <tbody>
      @foreach($users as $user)
        @if($user->roles->displayname == 'Administrator' || $user->roles->displayname == 'administrator')

        <tr> 
      
        @else
        <tr data-toggle="modal" data-id="{{$user->user_id}}" data-name="{{$user->Name}}" data-email="{{$user->Email}}" data-role="{{$user->role_id}}" data-roledescription ="{{$user->roles->displayname}}" data-target="#edituser">
        
        @endif
          <td>{{$user->Name}}</td>
          <td>{{$user->Email}}</td>
          <td>{{$user->roles->displayname}}</td>
          <td>{{$user->created_at}}</td>

        </tr>
      @endforeach
    
  </tbody>
</table>

<div>
<button class="btn btn-success" style="float: right;" data-target="#Adduser" data-toggle="modal" > Add User</button>	


<div class="modal fade" id="Adduser" role="dialog" >
  <div class="modal-dialog modal-edit" style="width:1250px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
  
   <div class="panel panel-default">
    <div class="panel-heading">
  
    </div>
  
      <form method="post" action="/newuser">
        @csrf
        
        <label> Name</label>
        <input type="text" name="name" class="form-control" required>

        <label>Email Address</label>
        <input type="email" name="email" class="form-control" required>

        <label>Role</label>
        <select name="role" class="form-control" required>
          <option value="" selected> </option>
          @foreach($roles as $role)
          <option value="{{$role->role_id}}">{{$role->displayname}}</option>
          @endforeach
        </select>
    </div>
   </div>

     
      <div class="modal-footer">
        <button type="button"   class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <input type="submit" name="" class="btn btn-primary" value="Save">
         </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>



<!-- Edit user -->
<div class="modal fade" id="edituser" role="dialog" >
  <div class="modal-dialog modal-edit" style="width:1250px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
  
   <div class="panel panel-default">
    <div class="panel-heading">
  
    </div>
  
      <form method="post" action="/updateuser">
        @csrf
        
        <input type="hidden"  id="id" name="user_id">
        <label> Name</label>
        <input type="text" name="name" id="name" class="form-control" required>

        <label>Email Address</label>
        <input type="email" name="email" id="email" class="form-control" required >

        <label>Role</label>
        <select name="role" id="select"   class="form-control" required >
          <option value="" selected id="default"> </option>
          <option disabled></option>
          @foreach($roles as $role)
          <option value="{{$role->role_id}}">{{$role->displayname}}</option>
          @endforeach
        </select>
    </div>
   </div>

     
      <div class="modal-footer">
       <a href="/deleteuser" id="deletemethod" class="btn btn-danger"  style="margin-right: 220px;">Delete</a>
        <button type="button"   class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <input type="submit" name="" class="btn btn-primary" value="Update">
         </form>
      </div>
    </div>
  </div>
</div>
  
</div>
</div>

<script type="text/javascript">
  
$(document).ready(function(){
var sel = document.getElementById('select');

$('#edituser').on('show.bs.modal', function (event){
  
  var button = $(event.relatedTarget); 
  var modal = $(this);
  var id = button.data('id');
  var name= button.data('name');
  var email  = button.data('email');
  var role = button.data('role');
  var roledescription = button.data('roledescription');


  modal.find('.modal-body #id').val(id);
  modal.find('.modal-body #name').val(name);
  modal.find('.modal-body #email').val(email);

  $('#default').val(role);

  document.getElementById("default").innerHTML = roledescription;

  $('#deletemethod').each(function(){
     this.href += '/'.concat(id);
})
});


});

</script>


@endsection
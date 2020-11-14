@extends('masterlayout.adminlayout')

@section('content')

<style type="text/css">
	
</style>

<div >
<label style="font-size:20px"><b>Roles </b></label>
<label style="float:right;">User Management > Roles</label>	
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
      <th scope="col">Display Name</th>
      <th scope="col">Description</th>
      <th scope="col">Created_at</th>
     
    </tr>
  </thead>
  <tbody>
    @foreach($roles as $role)
       @if($role->displayname == 'Administrator' || $role->displayname == 'administrator')
       <tr>
        @else
         <tr data-toggle="modal" data-id="{{$role->role_id}}" data-name="{{$role->displayname}}" data-description="{{$role->description}} "  data-target="#editrole">
        @endif
   
        <td>{{$role->displayname}}</td>
        <td>{{$role->description}}</td>
        <td>{{$role->created_at}}</td>

    </tr>
    @endforeach
    
  </tbody>
</table>

<div>
<button class="btn btn-success" style="float: right;"  data-target="#AddRole" data-toggle="modal" > Add Role</button>	


<div class="modal fade" id="AddRole" role="dialog" >
  <div class="modal-dialog modal-edit" style="width:1250px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
  
   <div class="panel panel-default">
    <div class="panel-heading">
  
    </div>
  
      <form method="post" action="/newrole">
        @csrf
        
        <label>Display Name</label>
        <input type="text" name="displayname" class="form-control" required>

        <label>Description</label>
        <input type="text" name="description" class="form-control" required>
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

<!-- Edit role -->
<div class="modal fade" id="editrole" role="dialog" >
  <div class="modal-dialog modal-edit" style="width:1250px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
  
   <div class="panel panel-default">
    <div class="panel-heading">
  
    </div>
  
      <form method="post" action="/updaterole">
        @csrf
        <input type="hidden" name="role_id" id="role_id">
        <label>Display Name</label>
        <input type="text" name="displayname" id="displayname" class="form-control" required>

        <label>Description</label>
        <input type="text" name="description" id="description" class="form-control" required>
    </div>
   </div>

     
      <div class="modal-footer">
       <a href="/deleterole" id="deletemethod" class="btn btn-danger"  style="margin-right: 220px;">Delete</a>
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

$('#editrole').on('show.bs.modal', function (event){
  var button = $(event.relatedTarget); 
  var modal = $(this);
  var id = button.data('id');
  var name= button.data('name');
  var description  = button.data('description');

  modal.find('.modal-body #role_id').val(id);
  modal.find('.modal-body #displayname').val(name);
  modal.find('.modal-body #description').val(description);

  $('#deletemethod').each(function(){
     this.href += '/'.concat(id);
})
});


});

</script>



@endsection
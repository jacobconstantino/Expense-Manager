@extends('masterlayout.adminlayout')

@section('content')

<style type="text/css">
	
</style>

<div >
<label style="font-size:20px"><b>Expense Categories </b></label>
<label style="float:right;">Expense Management > Expense Categories</label>	
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
      <th scope="col"> Created_at</th>
     
    </tr>
  </thead>
  <tbody>
      @foreach($category as $cat)
      <tr data-toggle="modal" data-id="{{$cat->category_id}}" data-name="{{$cat->name}}"  data-description ="{{$cat->description}}" data-target="#editcategory">
          <td>{{$cat->name}}</td>
          <td>{{$cat->description}}</td>
          <td>{{$cat->created_at}}</td>
      </tr>
      @endforeach
    
  </tbody>
</table>

<div>
<button class="btn btn-success" style="float: right;" data-target="#Category" data-toggle="modal"> Add Category</button>	

<div class="modal fade" id="Category" role="dialog" >
  <div class="modal-dialog modal-edit" style="width:1250px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
  
   <div class="panel panel-default">
    <div class="panel-heading">
  
    </div>
  
      <form method="post" action="/newcategory">
        @csrf
        
        <label>Display Name</label>
        <input type="text" name="name" class="form-control" required>

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
  


<!-- Edit category -->
<div class="modal fade" id="editcategory" role="dialog" >
  <div class="modal-dialog modal-edit" style="width:1250px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
  
   <div class="panel panel-default">
    <div class="panel-heading">
  
    </div>
  
      <form method="post" action="/updatecategory">
        @csrf
        
        <input type="hidden"  id="id" name="user_id">
        <label> Display Name</label>
        <input type="text" name="name" id="name" class="form-control" required>

        <label>Description</label>
        <input type="text" name="description" id="description" class="form-control" required>

      
      
    </div>
   </div>

     
      <div class="modal-footer">
       <a href="/deletecategory" id="deletemethod" class="btn btn-danger"  style="margin-right: 220px;">Delete</a>
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

$('#editcategory').on('show.bs.modal', function (event){

  var button = $(event.relatedTarget); 
  var modal = $(this);
  var id = button.data('id');
  var name= button.data('name');
  var description = button.data('description');


  modal.find('.modal-body #id').val(id);
  modal.find('.modal-body #name').val(name);
  modal.find('.modal-body #description').val(description);

  $('#deletemethod').each(function(){
     this.href += '/'.concat(id);
});


});
});

</script>
@endsection
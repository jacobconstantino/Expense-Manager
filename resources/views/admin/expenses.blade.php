@extends('masterlayout.adminlayout')

@section('content')

<style type="text/css">
	
</style>

<div >
<label style="font-size:20px"><b>Expense  </b></label>
<label style="float:right;">Expense Management > Expense </label>	
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
      <th>Name</th>
      <th scope="col">Expenses Category</th>
      <th scope="col">Amount</th>
      <th scope="col"> Entry Date</th>
      <th scope="col" >Created_at</th>
     
    </tr>
  </thead>
  <tbody>
    @foreach($expenses as $expense)
    <tr data-toggle="modal" data-id="{{$expense->expense_id}}"  data-categoryid="{{$expense->category_id}}" data-amount="{{$expense->amount}}"  data-entry ="{{$expense->entry}}" data-categoryname="{{$expense->category->name}}" data-target="#editexpense">
      <td>{{$expense->user->Name}}</td>
      <td>{{$expense->category->name}}</td>
      <td>${{$expense->amount}}</td>
      <td>{{$expense->entry}}</td>
      <td>{{$expense->created_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>

<div>
<button class="btn btn-success" style="float: right;" data-target="#expenses" data-toggle="modal"> Add Expense</button>  

<div class="modal fade" id="expenses" role="dialog" >
  <div class="modal-dialog modal-edit" style="width:1250px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Expense</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
  
   <div class="panel panel-default">
    <div class="panel-heading">
  
    </div>
  
      <form method="post" action="/newexpense">
        @csrf
        
        <label>Expense Category</label>
         <select name="category" class="form-control" required>
          <option value="" selected> </option>
          @foreach($category as $cat)
          <option value="{{$cat->category_id}}">{{$cat->name}}</option>
          @endforeach
        </select>

        <label>Amount</label>
        <input type="number" name="amount" min="1" max="10000" class="form-control" required>

        <label>Entry Date</label>
        <input type="date" name="date" class="form-control" required>
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

<!-- Edit expenses -->
<div class="modal fade" id="editexpense" role="dialog" >
  <div class="modal-dialog modal-edit" style="width:1250px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Expenses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
  
   <div class="panel panel-default">
    <div class="panel-heading">
  
    </div>
  
       <form method="post" action="/updateexpense">
        @csrf
        <input type="hidden"  id="expense_id" name="expense_id">
        <label>Expense Category</label>
         <select name="category" id="category" class="form-control" required >
          <option value="" id='default' selected> </option>
          <option disabled></option>
          @foreach($category as $cat)
          <option value="{{$cat->category_id}}">{{$cat->name}}</option>
          @endforeach
        </select>

        <label>Amount</label>
        <input type="number" name="amount" min="1" max="10000" id="amount" class="form-control" required >

        <label>Entry Date</label>
        <input type="date" name="date"  id="date" class="form-control" required >

      
      
    </div>
   </div>

     
      <div class="modal-footer">
       <a href="/deleteexpense" id="deletemethod" class="btn btn-danger"  style="margin-right: 220px;">Delete</a>
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

$('#editexpense').on('show.bs.modal', function (event){

  var button = $(event.relatedTarget); 
  var modal = $(this);
  var id = button.data('id');
  var category_id = button.data('categoryid');
  var amount = button.data('amount');
  var entry = button.data('entry');
  var categoryname = button.data('categoryname');

  modal.find('.modal-body #expense_id').val(id);
  modal.find('.modal-body #amount').val(amount);

  $('#default').val(category_id);
  document.getElementById("default").innerHTML = categoryname;

 $("#date").each(function() {    
    $(this).datepicker('setDate', $(this).val(entry));
});
  $('#deletemethod').each(function(){
     this.href += '/'.concat(id);
});


});
});
</script>

@endsection
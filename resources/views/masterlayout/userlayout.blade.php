<!doctype html>
<html lang="en">
  <head>
    <title>Expense Manager</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    

    <style type="text/css">
      .logout{
        width: 100%;
        margin-top:-30px;
      }
     /* .right{
        float:right;
      }*/
      .maincontent{
        margin-top: 60px;
      }
    </style>
  </head>
  <body>
    
    <div class="wrapper d-flex align-items-stretch">
      <nav id="sidebar">
        <div class="p-4 pt-5">
          <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(images/female.png );"></a>
          <label><b>{{session()->get('fullname')}} ({{session()->get('role')}}) </b></label>

          <ul class="list-unstyled components mb-5">
            <li>
              <a href="/userchart">Dashboard</a>
            </li>
            <li>
              <a href="/usermanagement">User Management </a>
            </li>
            <li>
              <a href="/userexpenses">Expenses</a>
            </li>
            
          </ul>

         

        </div>
      </nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

       <div class="logout">
        <div class="right">
           
         <label >Welcome To Expense Manager</label>
          <a href="/logout" class="btn btn-success" style="float:right;" >Logout</a>
         <hr>
        </div>
       </div>

       <div class="maincontent">
  
        @yield('content')
     </div>
    </div>


    <script src="js/jquery.min.js"></script>
   
     <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>


 <script type="text/javascript">
   $(document).ready(function(){


 
});


    </script>
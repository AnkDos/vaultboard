<?php
ob_start();
session_start();
require 'con.php';
if(isset($_POST['btn'])){
   $uname = $_POST['email'];
   $pass = $_POST['pass'];
   $qer= mysqli_query($conn,"select * from users where mail = '$uname'");
   $fet = mysqli_fetch_assoc($qer);
   $pass2 = $fet['pass'];     
   if($pass == $pass2){
       $_SESSION['id'] = $fet['uid'];
      header("Location: home.php");
   }else{
       echo "<script> alert('There was an error , Please try again !'); </script>";
   }
}

if(isset($_POST['btn2'])){
    $uname = $_POST['uname2'];
    $pass = $_POST['pass2'];
    $email = $_POST['mail'];
    $ins = mysqli_query($conn,"insert into users(uname,pass,mail) values ('$uname','$pass','$email')");
    if($ins){
        echo "<script> alert('Sucessfull , Login to continue'); </script>";
    }else{
        echo mysqli_error($conn);
        // echo "<script> alert('There was an error , Please try again !'); </script>";
    }
    
}

ob_end_flush();
?>
<html>

<head>
  <!-- Bootstrap Link -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title> Vault Board Task </title>
</head>
<!-- Bootstrap Link -->

<body>


  <div class="container">
    <div class="row">
      <div class="col-sm-4">
      </div>
      <div class="col-sm-4">
        <h1 class="display-1"> Hello !  </h1>
      </div>
    </div>
  </div>
  <br><br>

  <div class="container">
    <div class="row">
      <div class="col-sm-5">
        <h4 class="display-4"> Login </h4>
        <div class="form-group">
          <form method="post">
            <input type="email" class="form-control" name="email" placeholder="email"><br>
            <input type="text" class="form-control" name="pass" placeholder="Password"><br>
            <button type="submit" class="btn btn-primary mb-2" name="btn">Login</button>
          </form>
        </div>

      </div>
      <div class="vertical-bar"></div>


      <div class="col-sm-6">
        <h4 class="display-4"> Sign up </h4>

        <div class="form-group">
          <form method="post">
            <input type="email" class="form-control" name="mail" placeholder="E-mail"><br>
            <input type="text" class="form-control" name="uname2" placeholder="User Name"><br>
            <input type="text" class="form-control" name="pass2" placeholder="Password"><br>
            <button type="submit" class="btn btn-primary mb-2" name="btn2">Sign Up</button>
          </form>
        </div>


      </div>

    </div>

  </div>


  <footer>


    <div class="row">
      <div class="col-sm-2">
        Developed By :
        <br>
        Ankur Pandey
        <br>
        hello@ankdos.me
      </div>
      <div class="col-sm-6"></div>

      <div class="col-sm-2">For the internship Task . </div>
    </div>

  </footer>

  <!-- Js Link -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <!-- Js Link -->

</body>

</html>
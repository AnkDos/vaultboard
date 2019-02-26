<?php
   require 'con.php';
   if(isset($_GET['val'])){
       $pid = $_GET['val'];
       $qer = mysqli_query($conn,"select * from posts where pid = '$pid'");
       $fet = mysqli_fetch_assoc($qer);
       $tit =   $fet['title'] ;
       $pids = $fet['uid'] ;
        $fet3 = mysqli_query($conn,"select * from users where uid = '$pids'");
                          $fet4 = mysqli_fetch_assoc($fet3);
                          $auth = $fet4['uname'];
       
       
   }
?>

<html>

<head>
    <!-- Bootstrap Link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title> Vault Board Task Home</title>
</head>
<!-- Bootstrap Link -->

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="display-1"> " <?php echo $tit ; ?> "<p>
                </h2>
                <h4> By : <?php echo $auth ; ?> </h4>
                <h4> Date : <?php echo $fet['datent'] ; ?> </h4>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <blockquote>
                    <br>
                    <p id="br">

                       <?php echo  $fet['content'] ;?>
                    </p>

                </blockquote>
            </div>
        </div>
    </div>


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
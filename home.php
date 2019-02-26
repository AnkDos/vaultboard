<?php
   ob_start();
 error_reporting(0);
   session_start();
   
   require 'con.php';
   
   if(!isset($_SESSION['id'])){
       header("Location: index.php");
   }
   
   $sid = $_SESSION['id'];
   
    
$currentDir = getcwd();
    $uploadDirectory = "/uploads/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg','jpg','png','pdf','doc','txt']; // Get all the file extensions

    $fileName = $_FILES['myfile']['name'];
    $fileSize = $_FILES['myfile']['size'];
    $fileTmpName  = $_FILES['myfile']['tmp_name'];
    $fileType = $_FILES['myfile']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

    if (isset($_POST['submit'])) {

              
           $title    =  $_POST['title'] ;
           $content =  trim($_POST['content']) ;
           
               $myfile =$fileName ; 
            $kw =   $_POST['kw'] ;
            $current_timestamp = time();
             
        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if ($fileSize > 2000000) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                // echo "The file " . basename($fileName) . " has been uploaded";
            } else {
                // echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                // echo $error . "These are the errors" . "\n";
            }
        }
      
      
      $sql = "INSERT INTO posts (uid, title, content, keywords,filez) VALUES ('$sid', '$title', '$content', '$kw','$myfile')";
      $ins = mysqli_query($conn,$sql);
      
        if($ins){
            echo "<script> alert('Submited sucessfully') </script>";
        }else{
            
            echo mysqli_error($conn);
        }
    }    
    
    
    
    if(isset($_GET['so'])){
        unset($_SESSION['id']);
        session_destroy();
        header("Location: index.php");
    }
    
    if(isset($_GET['dw'])){
        $loc = $_GET['dw'] ;
        $file_url = "https://vaultit.000webhostapp.com/uploads/$loc";
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
readfile($file_url);
        
        
    }
   
  ob_end_flush();
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

    <nav aria-label="breadcrumb breadcrumb-fixed">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page" href="#contri">Contribute </li>
            <li class="breadcrumb-item "><a href="#read" class="col-cl"> Read Posts</li></a>
            <li class="breadcrumb-item "><a href="?so" class="col-cl"> Sign Out</li></a>
        </ol>
    </nav>

    <section id="contri">
        <div class="container">
            <div class="row">
                <div class="col-sm-10">
                    <h3 class = "display-3">Submit the article here !</h3>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Enter Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>

                        <div class="form-group">
                            <label>Enter the Content</label>
                            <textarea class="form-control" rows="5" name="content"></textarea>
                        </div>

                        <div class="form-group">
                                <label>Enter Keywords comma(,) Seperated </label>
                                <input type="text" class="form-control" name="kw" required>
                            </div>
                         
                         

                        <div class="form-group">
                            <label>OR Upload the file</label>
                            <input type="file" class="form-control-file" name="myfile">
                        </div>
                        <button type="submit" class="btn btn-dark" name="submit">Submit</button>
                    </form>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
    </sction>


    <section id="read">

        <div class ="container">
          <div class = "row">
             <div class = "col-sm-12">
                    
                    <h3 class = "display-3">View Articles</h3> <p> Click on the title name to read . 
                            <input type="text" class="form-control" id = "inp" placeholder = "type keywords to search">
                            <button type="button" class = "btn btn-dark" onclick="zunction()">Search Keyword</button>
                        <table class="table" id ="table">
                            <thead>
                              <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Date</th>
                                <th>Keywords</th>
                                <th>Download</th>
                            </tr>
                            </thead>
                            <tbody>
                        <?php
                           $qerz = mysqli_query($conn,"select * from posts ORDER BY pid DESC");
                           
                           while($fetz = mysqli_fetch_array($qerz)){
                          
                           $pids = $fetz['uid'];
                           $poi = $fetz['pid'];
                           $tit = $fetz['title'];
                           
                           $dt = $fetz['datent'];
                           $kw = $fetz['keywords'];
                           $dw = $fetz['filez'];
                          $fet3 = mysqli_query($conn,"select * from users where uid = '$pids'");
                          $fet4 = mysqli_fetch_assoc($fet3);
                          $auth = $fet4['uname'];
                            
                            
                        ?>        
                                
                              <tr>
                                <td><a href="read.php?val=<?php echo $poi;?>"> <?php echo $tit;?> </td>
                                <td><?php echo $auth;?></td>
                                <td><?php echo $dt;?></td>
                               <td>  <?php echo $kw;?> </td>
                               
                               <?php
                               $len = strlen($dw);
                               if($len > 1){
                               ?>
                                 <td><a class="btn btn-light" name="btn" href="?dw=<?php echo $dw ;?>">Download</a></td>
                             <?php
                              }else{
                                  
                              
                             ?>
                             <td>No Files Uploaded</td>
                             <?php
                              }
                             ?>
                              </tr>
                          
            <?php
                           }
            ?>
                            </tbody>
                          </table>
             
           


        </div>
          </div>    
        
        </div>

    </sction>





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
    <script>
            function zunction() {
                

                
  var input, filter, table, tr, td, i, txtValue;




  input = document.getElementById("inp");
  filter = input.value.split(',').join('').toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  
}







            }
            </script>
            

</body>

</html>
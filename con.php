
<?php
 
 define('DBHOST', 'localhost');
 define('DBUSER', 'root');
 define('DBPASS', '');
 define('DBNAME', '');
 $conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
 if ( !$conn ) {
  echo "not connected";
 }

?>
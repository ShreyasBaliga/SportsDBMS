<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_NAME', 'Users');
    
   /* Attempt to connect to MySQL database */
   $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
   // Check connection
   if($mysqli === false){
       die("ERROR: Could not connect. " . $mysqli->connect_error);
   }
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM UserName WHERE username = '$myusername' and passcode = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
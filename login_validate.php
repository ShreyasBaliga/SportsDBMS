<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sportsdb";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['club_id']) && isset($_POST['clubPassword'])){

        $club_id = $_POST['club_id'];
        $clubPassword = $_POST['clubPassword'];

        $sql_statement = $conn->prepare("SELECT * FROM CLUBS WHERE club_id = ?");
        $sql_statement->bind_param("s", $club_id);

        if ($sql_statement->execute()) {
            $club = $sql_statement->get_result()->fetch_assoc();
            $sql_statement->close();
            
            $pass = $club['clubPassword'];
            if ($pass == $clubPassword && $club_id != "") {
                
                echo ('
                <form name="clubs" action="players.php" method="POST">
                    <input type="hidden" name="club_id" value='.$club_id.'>
                    <input type="hidden" name="loggedIn" value=1>
                </form>
                <script type="text/javascript">
                    document.clubs.submit();
                </script>
                ');
            }
            else{
                $message = "Username and/or Password incorrect.Try again.";
                echo "<script type='text/javascript'>alert('$message');location='login.php';</script>";            
            }
        }
    }
    else{
            
        $response["error"] = TRUE;
        $response["error_msg"] = "Required parameters email or password is missing!";
        echo json_encode($response);
}
?> 

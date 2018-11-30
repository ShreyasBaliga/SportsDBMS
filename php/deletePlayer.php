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
if(isset($_POST['player_id'])){

        $player_id = $_POST['player_id'];

        $sql_statement = $conn->prepare("DELETE FROM PLAYER WHERE player_id = ?");
        $sql_statement->bind_param("s", $player_id);

       if ($sql_statement->execute()) {

            echo('
            <form name="myform" action="../players.php" method="POST">
                <input type="hidden" name="club_id" value='.$_POST["club_id"].'>
                <input type="hidden" name="loggedIn" value='.$_POST["loggedIn"].'>             
            </form>
            <script type="text/javascript">
                document.myform.submit();
            </script>
        ');
            
    }
    else{
            
        $response["error"] = TRUE;
        $response["error_msg"] = "Required parameters email or password is missing!";
        echo json_encode($response);
    }

}
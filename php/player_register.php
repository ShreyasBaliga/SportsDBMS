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
if(isset($_POST['player_id']) && isset($_POST['player_name'])){
         
        $player_name = $_POST['player_name'];
        $player_age = $_POST['player_age'];
        $player_sex = $_POST['player_sex'];
        $club_id = $_POST['club_id'];
	
        $player_id = $_POST['player_id'];
        $no_of_matches = $_POST['no_of_matches'];
        $injured = $_POST['injured'];
        $man_of_match = $_POST['man_of_match'];
        $last_score_updated = $_POST['last_score_updated'];
        $worth = $_POST['worth'];
        $goals_runs = $_POST['goals_runs'];
        $position = $_POST['position'];


        $sql_statement_1 = $conn->prepare("INSERT INTO player(player_id, player_name, player_age, player_sex, club_id) VALUES(?, ?, ?, ?, ?)");
        $sql_statement_1->bind_param("sssss", $player_id, $player_name, $player_age, $player_sex,$club_id);
        

         	
        $sql_statement_2 = $conn->prepare("INSERT INTO stats(player_id, no_of_matches, injured, man_of_match, last_score_updated,worth,goals_runs,position) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $sql_statement_2->bind_param("ssssssss", $player_id, $no_of_matches, $injured, $man_of_match,$last_score_updated,$worth,$goals_runs,$position);
           
        if ($sql_statement_1->execute() && $sql_statement_2->execute()) {

            $sql_statement_1->close();
            $sql_statement_2->close();
            
            echo('
            <form name="myform" action="../players.php" method="POST">
                <input type="hidden" name="club_id" value='.$club_id.'>
                <input type="hidden" name="loggedIn" value=1>            
            </form>
            <script type="text/javascript">
                document.myform.submit();
            </script>
        ');

            }

        
    }
    else{
            
        $response["error"] = TRUE;
        $response["error_msg"] = "Required parameters email or password is missing!";
        echo json_encode($response);
}

?> 

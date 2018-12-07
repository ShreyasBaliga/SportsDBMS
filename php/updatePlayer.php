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


$player_id = $_POST['player_id'];
$no_of_matches = $_POST['no_of_matches'];
$injured = $_POST['injured'];
$man_of_match = $_POST['man_of_match'];
$last_score_updated = $_POST['last_score_updated'];
$worth = $_POST['worth'];
$goals_runs = $_POST['goals_runs'];
$position = $_POST['position'];



$sql_statement = $conn->prepare("UPDATE stats SET  no_of_matches=?, injured=?, man_of_match=?, last_score_updated=?,worth=?,goals_runs=?,position=? WHERE player_id=?");
$sql_statement->bind_param("ssssssss",$no_of_matches, $injured, $man_of_match,$last_score_updated,$worth,$goals_runs,$position ,$player_id);

if ($sql_statement->execute()) {

    echo('
    <form name="myform" action="../stats.php" method="POST">
        <input type="hidden" name="player_id" value='.$player_id.'>
        <input type="hidden" name="loggedIn" value=1>            
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

?> 
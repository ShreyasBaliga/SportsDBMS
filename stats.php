<!DOCTYPE html>
<html lang="en" >

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sportsdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$player_id = $_POST['player_id'];

$sql = "SELECT player_name FROM PLAYER WHERE player_id='$player_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo('<head>
<meta charset="UTF-8">
<title>Players</title>
   <link rel="stylesheet" href="CSS/table_style.css">
   <link rel="stylesheet" href="CSS/sports.css" /> 
   <h1 align="center">'.$row["player_name"].'</h1>
</head>

<body>
');
$sql = "SELECT * FROM STATS WHERE player_id='$player_id'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

if($_POST['loggedIn']==1){
echo ('
    <table class="container">
    <tbody>
    <form name="updatePlayer" action="CRUD/updatePlayer.php" method="POST">
        <div><button name="submit" type="submit" class="xop-button">Update</button></div>
        <input type="hidden" name="player_id" value='.$row["player_id"].'>
        <tr>
            <td>No of matches played</td>
            <td><input type="text" name="no_of_matches" value='.$row["no_of_matches"].'  style ="background-color:Transparent;border: none;color:white; "></td>
        </tr>

        <tr>
            <td>Last score updated</td>
            <td><input type="text" name="last_score_updated" value='.$row["last_score_updated"].' style ="background-color:Transparent;border:none;color:white;"></td>
        </tr>


        <tr>
            <td>Times man of match</td>
            <td><input type="text" name="man_of_match" value='.$row["man_of_match"].' style ="background-color:Transparent;border:none;color:white;"></td>
        </tr>

        <tr>
            <td>Player Worth</td>
            <td><input type="text" name="worth" value='.$row["worth"].' style ="background-color:Transparent;border:none;color:white;"></td>
        </tr>

        <tr>
            <td>Score</td>
            <td><input type="text" name="goals_runs" value='.$row["goals_runs"].' style ="background-color:Transparent;border:none;color:white;"></td>
        </tr>

        <tr>
            <td>Position</td>
            <td><input type="text" name="position" value='.$row["position"].' style ="background-color:Transparent;border:none;color:white;"></td>
        </tr>

        <tr>
            <td>Injury</td>
            <td><input type="text" name="injured" value='.$row["injured"].' style ="background-color:Transparent;border:none;color:white;"></td>
        </tr>
   
    </tbody>
    </table>
    </form>
');
}
else{
    echo ('
    <table class="container">
    <tbody>
    <tr>
        <td>No of matches played</td>
        <td>'.$row["no_of_matches"].'</td>
    </tr>

    <tr>
        <td>Last Score Updated</td>
        <td>'.$row["last_score_updated"].'</td>
    </tr>


    <tr>
        <td>Times man of match</td>
        <td>'.$row["man_of_match"].'</td>
    </tr>

    <tr>
        <td>Player Worth</td>
        <td>'.$row["worth"].'</td>
    </tr>

    <tr>
        <td>Score</td>
        <td>'.$row["goals_runs"].'</td>
    </tr>

    <tr>
        <td>Position</td>
        <td>'.$row["position"].'</td>
    </tr>

    <tr>
        <td>Injury</td>
        <td>'.$row["injured"].'</td>
    </tr>
    </tbody>
    </table>

');
}
$conn->close();
?> 


  
  

</body>

</html>
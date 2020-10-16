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

$club_id = $_POST['club_id'];


$sql = "SELECT image_url FROM CLUBS WHERE club_id='$club_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo('<head>
<meta charset="UTF-8">
<title>Players</title>
   <link rel="stylesheet" href="CSS/table_style.css">
   <link rel="stylesheet" href="CSS/sports.css" /> 
   <img src="data:image/png;base64,'.base64_encode($row["image_url"]).'" height=100 width=100 class="center"/>
</head>

<body>
<table class="container">
  <thead>
      <tr>
          <th><h1>Name</h1></th>
          <th><h1>Age</h1></th>
          <th><h1>Sex</h1></th>
      </tr>
  </thead>
  <tbody>');
$sql = "SELECT * FROM PLAYER WHERE club_id='$club_id'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo ('<tr>
    <td>'.$row["player_name"].'</td>
    <td>'.$row["player_age"].'</td>
    <td>'.$row["player_sex"].'</td>
    <td>               
            <form name="sport" action="stats.php" method="POST">
                    <input type="hidden" name="player_id" value='.$row["player_id"].'>
                    <input type="hidden" name="loggedIn" value='.$_POST['loggedIn'].'>
                    <button name="submit" type="submit" class="xop-button">Stats</button>
            </form>
    </td>');
        if($_POST['loggedIn']==1){
        echo('<td>               
                <form name="deletePlayer" action="CRUD/deletePlayer.php" method="POST">
                        <input type="hidden" name="player_id" value='.$row["player_id"].'>
                        <input type="hidden" name="club_id" value='.$row["club_id"].'>
                        <input type="hidden" name="loggedIn" value='.$_POST['loggedIn'].'>
                        <button name="submit" type="submit" class="xop-button">Delete</button>
                </form>
        </td>');
    }
echo '</tr>';
}
echo ('
<form class="player-form" action="addPlayer.php" method="POST">');

if($_POST['loggedIn']==1){
    echo('<div><button name="club_id" type="submit" class="xop-button" value='.$club_id.' class="center" >Add Player</button></div>');
    
}

$conn->close();
?> 

	</tbody>
</table>
  
  

</body>

</html>
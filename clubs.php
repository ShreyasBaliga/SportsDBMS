<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Countries</title>
     <link rel="stylesheet" href="css/table_style.css">
     <link rel="stylesheet" href="css/sports.css" /> 
</head>

<body>
    
<table class="container">
	<thead>
		<tr>
            <th><h1></h1></th>
            <th><h1>Country</h1></th>
            <th><h1>Club</h1></th>
            <th><h1>Total Score</h1></th>
            <th></th>
		</tr>
	</thead>
	<tbody>


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
$mysqli = new mysqli($servername, $username, $password, $dbname);

$country_id = $_GET['country_id'];
$sport_id = $_GET['sport_id'];


$sql = "SELECT country_name FROM COUNTRIES WHERE country_id='$country_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$country_name = $row["country_name"]; 

$sql = "SELECT * FROM CLUBS WHERE country_id='$country_id' AND sport_id= '$sport_id'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    $procInput1 = $row["club_id"];
    $call = $mysqli->prepare('CALL total_worth(?, @sum)');
    $call->bind_param('s', $procInput1);
    $call->execute();

    $select = $mysqli->query('SELECT @sum');
    $result1 = $select->fetch_assoc();
    $res = $result1['@sum'];
    echo ('<tr>
    <td><img src="data:image/png;base64,'.base64_encode($row["image_url"]).'" height=48 width=48/></td>
    <td>'.$country_name.'</td>
    <td>'.$row["club_name"].'</td>
    <td>'.$res.'</td>
    <td>
        <form name="clubs" action="players.php" method="POST">
            <input type="hidden" name="club_id" value='.$row["club_id"].'>
            <input type="hidden" name="loggedIn" value=0>
            <button name="submit" type="submit" class="xop-button">Select</button>
        </form>
    </td>
    </tr>');
    }
$conn->close();
?> 

	</tbody>
</table>
  
  

</body>

</html>
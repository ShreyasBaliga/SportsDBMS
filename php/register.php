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
if(isset($_POST['club_id']) && isset($_POST['password'])){

        $club_id = $_POST['club_id'];
        $password = $_POST['password'];
        $club_name = $_POST['club_name'];
        $sport_name = $_POST['sport_name'];
        $image_url = $_POST['image_url'];
        $country_name = $_POST['country_name'];

        $sql = "SELECT country_id FROM COUNTRIES WHERE country_name='$country_name'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $country_id = $row["country_id"]; 
    
        $sql = "SELECT sport_id FROM SPORTS WHERE sport_name='$sport_name'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $sport_id = $row["sport_id"]; 

        $sql_statement = $conn->prepare("INSERT INTO clubs(club_id, club_name, country_id, sport_id, password,image_url) VALUES(?, ?, ?, ?, ?, ?)");
        $sql_statement->bind_param("ssssss", $club_id, $club_name, $country_id, $sport_id,$password,$image_url);
        
        if ($sql_statement->execute()) {

            $sql_statement->close();

                echo "Sucess";

            }

        
    }
    else{
            
        $response["error"] = TRUE;
        $response["error_msg"] = "Required parameters email or password is missing!";
        echo json_encode($response);
}

?> 

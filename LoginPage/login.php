<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$player_name = $player_age = $player_sex = "";
$name_err = $age_err = $sex_err = "";
$id = $_GET["item_id"];
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["player_name"]);
    if(empty($input_name)){
        $name_err = "Please enter player name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $player_name = $input_name;
    }
    
    // Validate age
    $input_age = trim($_POST["player_age"]);
    if(empty($input_age)){
        $age_err = "Please enter the age";     
    } else{
        $player_age = $input_age;
    }
    
    // Validate sex
    $sex = trim($_POST["player_sex"]);
    if(empty($sex)){
        $sex_err = "Please enter the sex";     
    }else{
        $player_sex = $sex;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($age_err) && empty($sex_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO player (player_name, player_age, player_sex, club_id) VALUES (?, ?, ?,?)";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_name, $param_age, $param_sex, $param_id);
            
            // Set parameters
            $param_name = $player_name;
            $param_address = $player_age;
            $param_salary = $player_sex;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("newindex.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $player_name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($age_err)) ? 'has-error' : ''; ?>">
                            <label>Age</label>
                            <input type="text" name="age" class="form-control" value="<?php echo $player_age; ?>">
                            <span class="help-block"><?php echo $age_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($sex_err)) ? 'has-error' : ''; ?>">
                            <label>Salary</label>
                            <input type="text" name="sex" class="form-control" value="<?php echo $player_sex; ?>">
                            <span class="help-block"><?php echo $sex_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
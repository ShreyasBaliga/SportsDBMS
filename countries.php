<?php  
 $connect = mysqli_connect("localhost", "root", "", "sportsdb");  
 if(isset($_POST["insert"]))  
 {  
      $country_id = $_POST['country_id'];
      $country_name = $_POST['country_name'];
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"])); 
      $query = "INSERT INTO countries VALUES ('$country_id','$country_name','$file')";  
      if(mysqli_query($connect, $query))  
      {  
           echo '<script>alert("Image Inserted into Database")</script>';  
      }  
 }  
 ?>  
<!DOCTYPE html>  
 <html>  
      <head>  
           <title>SportsDB</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body background="CSS/countries.png">  
           <br /><br />  
           <div class="container"  style="width:800px;">    
                <br />
                <!--<form method="post" enctype="multipart/form-data">
                     <input type="text" placeholder="Country ID" name="country_id"/>
                     <input type="text" placeholder="Country Name" name="country_name"/>  
                     <input type="file" name="image" id="image"/>  
                     <br />  
                     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />  
                </form>  
                <br />-->
                <h1 style="text-align:center">Countries</h1>
                <br />
                <?php 
                $connect = mysqli_connect("localhost", "root", "", "sportsdb"); 
                $sport_id = $_GET["sport_id"];
                $query = "SELECT * FROM sport_country where sport_id='$sport_id'";  
                $result1 = mysqli_query($connect, $query);
                $i = 0;
                while($row1 = mysqli_fetch_array($result1))  
                {  
                    $country_id = $row1["country_id"];
                    $query = "SELECT * FROM countries where country_id='$country_id'";  
                    $result = mysqli_query($connect, $query);
                    $row = mysqli_fetch_array($result);
                    if($i%3 == 0){
                        echo '<div style="display:flex;">';
                    }
                    echo '<div style="flex: 33.33%;padding: 20px;">
                            <a href="clubs.php?country_id='.$row["country_id"].'&sport_id='.$sport_id.'">
                                <img src="data:image/jpeg;base64,'.base64_encode($row['image_url'] ).'"height="150" width="250"" />
                            </a>
                        </div>';
                    if($i%3 == 2){
                        echo"</div>";
                    }
                    $i++;
                } 
                
                ?>    
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>  
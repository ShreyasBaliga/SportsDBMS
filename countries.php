<!DOCTYPE html>  
 <html>  
      <head>  
           <title>SportsDB</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body background="css/countries.png">  
           <br /><br />  
           <div class="container"  style="width:800px;">    
                <br /> 
                <h1 style="text-align:center">Countries</h1>
                <br />
                <?php 
                $connect = mysqli_connect("localhost", "root", "", "sportsdb"); 
                $sport_id = $_GET["sport_id"];
                $query = "SELECT * FROM countries";  
                $result = mysqli_query($connect, $query);
                $i = 0;
                while($row = mysqli_fetch_array($result))  
                {  
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
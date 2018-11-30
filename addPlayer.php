<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Sports Database</title>
  <link rel="stylesheet" href="css/style.css">  
</head>

<body>	

<div class="player-form">
  <div class="form">
    <form class="player-register-form" action="php/player_register.php" method="POST">

      <input type="text" placeholder="Player ID" name="player_id"/>
      <input type="text" placeholder="Name" name="player_name"/>
      <input type="text" placeholder="Age" name="player_age"/>
      <input type="text" placeholder="Sex" name="player_sex"/>
    <?php
        $club_id = $_POST['club_id'];
        echo '<input type="hidden" name="club_id" value='.$club_id.'>';
    ?> 
      <input type="text" placeholder="Number of matches" name="no_of_matches"/>
      <input type="text" placeholder="Injured" name="injured"/>
      <input type="text" placeholder="Times man of match" name="man_of_match"/>
      <input type="text" placeholder="Last match played" name="last_match_played"/>
      <input type="text" placeholder="Score" name="goals_runs"/>
      <input type="text" placeholder="Position" name="position"/>
      <input type="text" placeholder="Player Worth" name="worth"/>

      <button>Submit</button>

    </form>
  </div>
</div>


</body>

</html>


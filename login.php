<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Sports Database</title>
  <link rel="stylesheet" href="CSS/style.css">  
</head>

<body>

<div class="login-page">
  <div class="form">
    <form class="register-form" action="CRUD/register.php" method="POST">
      <input type="text" placeholder="Club ID" name="club_id"/>
      <input type="text" placeholder="Club Name" name="club_name"/>
      <input type="text" placeholder="Country" name="country_name"/>
      <input type="text" placeholder="Sport" name="sport_name"/>
      <input type="file" name="image_url"/>
      <input type="password" placeholder="Password" name="clubPassword"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" action="login_validate.php" method="POST">
      <input type="text" placeholder="Club ID" name="club_id"/>
      <input type="password" placeholder="password" name="clubPassword"/>
      <button>login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>
$('.message').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
</script>

</body>

</html>

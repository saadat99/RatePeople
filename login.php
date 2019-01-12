<?php
// If user is logged in block access
include 'session.php';
if(isset($_SESSION['login_user'])) {
    header("Location: index.php"); // Redirecting To Home Page
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["uname"])) {
    $usernameErr = "Username is required";
  }
  // check if name only contains letters and whitespace
  elseif (!preg_match("/^[a-zA-Z ]*$/",$_POST["uname"])) {
    $usernameErr = "Only letters and white space allowed"; 
  }
  else {
    $username = test_input($_POST["uname"]);
  }
  
  if (empty($_POST["psw"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["psw"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($username) && isset($password)) {
  // Check if info exits in DB
  require_once 'DB.php';
  $db = new DB;
  $result = $db->select("Users", "*", "username='$username' AND password='$password'");

  if (empty($result)) {
    echo 'Your Username or Password is wrong';
  } else {
    require_once 'functions.php';
    login($username);
  }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    <script>
      $(function(){
      $("#includedContent").load("nav.php"); 
    });
    </script>
    <style>
      .error {color: #FF0000;}
      .container {
      width: 250px;
      clear: both;
      }

      .container input {
      width: 100%;
      clear: both;
      }
    </style>
    <title>Login</title>
</head>
<body>
  <div id="includedContent"></div>
  <div class="w3-container">
    <br>
    <div class="w3-card-4 w3-content">
      <!-- <div class="w3-container w3-green">
        <h2>Login From</h2>
      </div> -->

      <form class="w3-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p>
        <span class="error"><?php echo $usernameErr;?></span>
        <input class="w3-input" type="text" name="uname">
        <label>Username</label></p>
        <p>
        <span class="error"><?php echo $passwordErr;?></span>
        <input class="w3-input" type="password" name="psw" value="<?php echo $username;?>">
        <label>Password</label></p>
        <input class="w3-btn w3-blue" type="submit" ><br><br>
      </form>
    </div>
  </div>
</body>
</html>
<?php
// If user is logged in block access
require_once 'session.php';
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

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  }
  // check if e-mail address is well-formed
  elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format"; 
  }
  else {
    $email = test_input($_POST["email"]);
  }
  
  if (empty($_POST["psw"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["psw"]);
  }

  if (empty($_POST["rpsw"])) {
    $rpasswordErr = "Password is required";
  }
  // check if matches with password
  elseif ($password != $_POST["rpsw"]) {
    $rpasswordErr = "Passwords doesn't match";
  }
  else {
    $rpassword = test_input($_POST["rpsw"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Regiter
if(isset($username) && isset($email) && isset($password) && isset($rpassword)) {
  require 'DB.php';
  // $db = new DB;
  // $result = $db->select("Users", "*", "username='$username' OR email='$email'");
  // Store in DB
  $db = new DB;
  $result = $db->insert("Users", "username, password, email", "'$username', '$password', '$email'");
  if (!empty($result)) {
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
    <title>Sign Up</title>
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
        <span class="error"><?php if(isset($usernameErr)) echo $usernameErr;?></span>
        <input class="w3-input" type="text" name="uname" value="<?php if(isset($username)) echo $username;?>">
        <label>Username</label></p>

        <p>
        <span class="error"><?php if(isset($emailErr)) echo $emailErr;?></span>
        <input class="w3-input" type="text" name="email" value="<?php if(isset($email)) echo $email;?>">
        <label>Email</label></p>

        <p>
        <span class="error"><?php if(isset($passwordErr)) echo $passwordErr;?></span>
        <input class="w3-input" type="password" name="psw">
        <label>Password</label></p>

        <p>
        <span class="error"><?php if(isset($rpasswordErr)) echo $rpasswordErr;?></span>
        <input class="w3-input" type="password" name="rpsw">
        <label>Repeat Password</label></p>

        <input class="w3-btn w3-blue" type="submit" ><br><br>
      </form>
    </div>
  </div>
</body>
</html>

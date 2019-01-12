<?php
  require_once 'session.php';
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
    <title>SlebVote Rate People</title>
</head>
<body>
  <div id="includedContent"></div>

  <!-- Alerter -->
  <?php if(isset($_GET['alert'])): ?>
  <div class="w3-container w3-green w3-display-container">
    <span onclick="this.parentElement.style.display='none'"
    class="w3-button w3-small w3-display-topright">&times;</span>
    <!-- <h3>You are not signed in!</h3> -->
    <p>You are signed in! Welcome <?= $_SESSION['login_user'] ?></p>
  </div>
  <?php endif; ?>
  
  <!-- Band Description -->
  <section class="w3-container w3-center w3-content" style="max-width:600px">
    <h2 class="w3-wide">SlebVote</h2>
    <p class="w3-opacity"><i>We rate people</i></p>
    <p class="w3-justify">We have created a website. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
  </section>
</body>
</html>
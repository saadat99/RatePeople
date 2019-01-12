<!-- Navigation -->
<nav class="w3-bar w3-blue">
  <a href="/" class="w3-button w3-bar-item">Home</a>
  <a href="slebs.php" class="w3-button w3-bar-item">Slebs</a>
  <?php
  require_once 'session.php';
  if(!isset($_SESSION['login_user'])): ?>
    <a href="signup.php" class="w3-button w3-bar-item w3-grey w3-hover-green w3-right">Signup</a>
    <a href="login.php" class="w3-button w3-bar-item w3-grey w3-hover-green w3-right">Login</a>
  <?php else: ?>
    <a href="new_sleb.php" class="w3-button w3-bar-item">New Sleb</a>
    <a href="logout.php" class="w3-button w3-bar-item w3-grey w3-hover-red w3-right">Logout</a>
  <?php endif; ?>
</nav>
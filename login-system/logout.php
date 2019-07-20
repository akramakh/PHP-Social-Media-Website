<?php
/* Log out process, unsets and destroys session variables */
session_start();
session_unset();
session_destroy(); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Error</title>
  <?php include 'css/css.html'; ?>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!--<div class="form">
          <h1>Thanks for stopping by</h1>
              
          <p><?//= 'You have been logged out!'; ?></p>
          <?php header('Location:../');?>
          <a href="../"><button class="button button-block">Home</button></a>

    </div>-->
</body>
</html>

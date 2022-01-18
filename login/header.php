<?php

session_start()

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  </head>
  <body>
      
  <nav class="navbar  navbar-expand-lg " style="background-color: #171828; color:#fff">
  <a class="navbar-brand" href="login.php">First Task</a>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="index.php">my profile <span class="sr-only">(current)</span></a>
      <?php if(isset($_SESSION['user'])){ ?>
        <a class="nav-item nav-link" href="logout.php"> logout</a>

     <?php } ?>
      
      
  
    </div>
  </div>
</nav>



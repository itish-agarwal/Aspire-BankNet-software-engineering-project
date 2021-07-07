<?php include_once 'resource/session.php'; ?>

<!DOCTYPE html>
<html>
<head lang = "en">
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    
    <title><?php if(isset($page_title)) echo $page_title; ?></title>
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>
<body>
    
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Aspire Bank</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php" style = "font-weight: bold;">Home</a></li>

            <?php if(isset($_SESSION['username'])): ?>
             <!-- <p class="lead">You are currently not signed in. <a href = "login.php">Login. </a> Not a member yet? <a href = "signup.php"> SignUp </a></p> -->
              
            <li><a href="#" style="font-weight: bold;">My Bank</a></li>
              <li><a href="logout.php" style="font-weight: bold;">Exit</a></li>
<!--               

              <h1 style="font-weight:bold; margin-bottom: 25px;">Welcome to Aspire BankNet</h1>
        <p class="lead"><i>Now login to your bank account - <br> anytime, anywhere in the world!</i> </p> -->
              
             <?php else: ?>

              <!-- <p class="lead">You are logged in as <?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?> <a href = "logout.php"> Logout </a> </p> -->
              <li><a href="login.php" style="font-weight:bold;">Login</a></li>

              <li><a href="signup.php" style="font-weight:bold;">Register</a></li>
              <li><a href="about.php" style="font-weight: bold;">About</a></li>
              <li><a href="contact.php" style="font-weight:bold;">Contact</a></li>

             <?php endif ?>

       
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

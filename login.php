<?php

    include_once 'resource/session.php';
    include_once 'resource/Database.php';
    include_once 'resource/utilities.php';

    if(isset($_POST['loginBtn'])){

        $form_errors = array();

        $required_fields = array('username', 'password');

        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

        if(empty($form_errors)){
            //check if user exists in the database

            $user  = $_POST['username'];
            $password = $_POST['password'];

            $sqlQuery = "SELECT * FROM users WHERE username = :username";

            $statement = $db -> prepare($sqlQuery);

            $statement -> execute(array(':username' => $user));

            while($row = $statement->fetch()){
                $id = $row['id'];
                $hashed_password = $row['password'];
                $username = $row['username'];
                if(password_verify($password, $hashed_password)){

                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $username;

                    // echo "Weclome!";

                    redirectTo('index');
                }else{
                    $result = flashMessage("Invalid username or password");

                }
            }
        }else{
            if(count($form_errors) == 1){
                $result = flashMessage("There was 1 error in the form");

            }else{
                //

                $result = flashMessage("There were " .count($form_errors). " errors in the message");
            }
        }
    }
?>




<!DOCTYPE html>
<html>
<head lang = "en">
    <meta charset = "UTF-8">
    <link rel = "stylesheet" href = "css/custom.css" />
    <title>AspireBank Net - Login</title>
</head>
<body>

    <?php
     $page_title = "AspireBank Net - Homepage";
     include_once 'partials/headers.php';
    ?>

    <div class="container">
        <section class = "col col-lg-7">
         
            <h2 style="margin-top : 40px;"> Login form </h2>
            <div>
            <?php
                if(isset($result)) echo $result;
            ?>

            <?php
                if(!empty($form_errors)) echo show_errors($form_errors); 
            ?>
            </div>
            <div class = "clearfix" ></div>

            <form action ="" method = "post">
                <div class="form-group">
                    <label for="usernameField">Username</label>
                        <input type="text" class="form-control" name = "username" id="usernameField" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="passwordField">Password</label>
                        <input type="password" name = "password" class="form-control" id="passwordField" placeholder="Password">
  
                            <div class="checkbox">        
                            <!-- <label>
                            <input name = "remember" type="checkbox"> Remember me
                            </label> -->
                            </div>
                            <a href = "forgot_password.php"> Forgot password? </a>
                            <button name = "loginBtn" type="submit" class="btn btn-primary pull-right">Sign in</button>
            </form>
        </section>
    </div>


    <?php include_once 'partials/footers.php' ?>



</body>
</html>
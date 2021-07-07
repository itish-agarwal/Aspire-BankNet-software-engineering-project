<?php

    include_once 'resource/Database.php';
    include_once 'resource/utilities.php';

    if(isset($_POST['signupBtn'])){
        $form_errors = array();

        $required_fields = array('email', 'username', 'password');

        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

        $fields_to_check_length = array('username' => 4, 'password' => 6);

        $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

        $form_errors = array_merge($form_errors, check_email($_POST));
        
        
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
     
         
            if(cdouble("users", "username", $username, $db)){
                $result = flashMessage("Username is already taken, please try another one");
                // echo "svsdvsb";
            }
            else if(cdouble("users", "email", $email, $db)){
                $result = flashMessage("Email is already taken, please try another one");
            }

            else if(empty($form_errors)){
          

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            try{

                //create a SQL statement

                $sqlInsert = "INSERT INTO users (username, email, password, join_date)
                              VALUES (:username, :email, :password, now())";

                $statement = $db -> prepare($sqlInsert);

                $statement -> execute(array(':username' => $username, ':email' => $email, ':password' => $hashed_password));

                if($statement -> rowCount() == 1){
                    $result = flashMessage("Registration successful", "Pass");
                }
            }catch (PDOException $ex){

                $result = flashMessage("An error occured" .$ex->getMessage());
            }

        }else{

            if(count($form_errors) == 1){

                $result = flashMessage("There was 1 error in the form <br>");
               

            }else{

                $result = flashMessage("There were " .count($form_errors). " errors in the form <br>");

            }
        }
    }
?>


    <?php
     $page_title = "AspireBank Net - SignUp";
     include_once 'partials/headers.php';
    ?>

    <div class="container">
        <section class = "col col-lg-7">
         
            <h2 style="margin-top : 40px;"> Registration form </h2>

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
                    <label for="emailField">Email</label>
                    <input type="text" class="form-control" name = "email" id="emailField" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="usernameField">Username</label>
                    <input type="text" class="form-control" name = "username" id="usernameField" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="passwordField">Password</label>
                    <input type="password" name = "password" class="form-control" id="passwordField" placeholder="Password">
  
                    <!-- <div class="checkbox">        
                    <label>
                    <input name = "remember" type="checkbox"> Remember me
                    </label>
                    </div>
                    <a href = "forgot_password.php"> Forgot password? </a> -->
                <button name = "signupBtn" type="submit" class="btn btn-primary pull-right" style="margin-top:13px;">Sign up</button>
            </form>
        </section>
    </div>


    <?php include_once 'partials/footers.php' ?>



</body>
</html>
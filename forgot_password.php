<?php
    include_once 'resource/Database.php';
    include_once 'resource/utilities.php';

    if(isset($_POST['passwordResetBtn'])){

        $form_errors = array();
        $required_feilds = array('email', 'new_password', 'confirm_password');

        $form_errors = array_merge($form_errors, check_empty_fields($required_feilds));

        $fields_to_check_length = array('new_password' => 6, 'confirm_password' => 6);

        $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

        $form_errors = array_merge($form_errors, check_email($_POST));

        if(empty($form_errors)){

            $email = $_POST['email'];
            $password1 = $_POST['new_password'];
            $password2 = $_POST['confirm_password'];
            if($password1 != $password2){

                $result = flashMessage("Passwords do not match");


            }else{
                try{


                    $sqlQuery = "SELECT email FROM users WHERE email = :email";
                    $statement = $db -> prepare($sqlQuery);

                    $statement -> execute(array(':email' => $email));

                    if($statement -> rowCount() == 1){
                        $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

                        $sqlUpdate = "UPDATE users SET password = :password WHERE email = :email";

                        $statement = $db -> prepare($sqlUpdate);
                        $statement -> execute(array(':password' => $hashed_password, ':email' => $email));
                        $result = flashMessage("Password reset successful", "Pass");

                    }else{

                        $result = flashMessage("The email address provided is not registered on Aspire BankNet, please try again");

                    }
                }catch(PDOException $ex){
                    $result = flashMessage("An error occured " .$ex->getMessage());
                }
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
     $page_title = "AspireBank Net - Forgot password?";
     include_once 'partials/headers.php';
    ?>

    <div class="container">
        <section class = "col col-lg-7">
         
            <h2 style = "margin-top : 40px;">  Password Reset Form  </h2>

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
                        <input type="text" class="form-control" name = "username" id="emailField" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="passwordField">New password</label>
                        <input type="password" name = "new_password" class="form-control" id="passwordField" placeholder="New password">
                
                        <div class="form-group">
                    <label for="passwordField" class="cfPassword">Confirm password</label>
                        <input type="password" name = "confirm_password" class="form-control" id="passwordField" placeholder="Old password">
  
                        <!-- <a href = "forgot_password.php"> Forgot password? </a> -->
                    <button name = "passwordResetBtn" type="submit" class="rpBtn btn btn-primary pull-right"> Reset password</button>
            </form>
        </section>
    </div>


    <?php include_once 'partials/footers.php' ?>

</body>
</html>

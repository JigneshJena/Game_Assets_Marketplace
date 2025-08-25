<?php
require 'db.php';


$message='';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username=trim($_POST['username']);
    $email=trim($_POST['email']);
    $full_name=trim($_POST['full_name']);
    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];

    if($password !==$confirm_password){
        $message="Passwords do not match.";
    }else{
        $password_to_save=$password;

        $insert_user_data=$conn->prepare("Insert into users (username,email, full_name,password)values(?,?,?,?)");
        $insert_user_data->bind_param("ssss",$username,$email,$full_name,$password_to_save);
     
        if($insert_user_data->execute()){
            $message="Registration successful! You can now <a href='login.php'>log in</a>.";
        }
       elseif($insert_user_data->errno==1062){         // This 1062 mean Duplicate entery for a unique key
            $message="Error: username or email already exits.";
        }else{
            $message="Error:". $insert_user_data->error;
        }
    }
    $insert_user_data->close();
}
$conn->close();
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Game asset Marketplace</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <?php include 'header.php' ?>

    <main class="main-content">
        <div class="container">
            <div class="from-container">
                <h2 class="text-center mb-2"></h2>
                <?php 
                if($message):?>

               <p class="text-center" style="color:green;"><?= htmlspecialchars($message)?></p>
               <?php endif;?>

                <form method="post" action="register.php">
                    <div class="form-group">
                        <label for="username">Username or Email</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="form-control"
                            require>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            require>

                    </div>

                    <div class="form-group">
                        <label for="full_name">Full name</label>
                        <input
                            type="text"
                            id="full_name"
                            name="full_name"
                            class="form-control"
                            require>
                    </div>

                    <div class="form-group">
                        <label for="password">password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            require>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">confirm Password</label>
                        <input type="password"
                            id="confirm_password"
                            name="confirm_password"
                            class="form-control"
                            require>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
               </form>
            </div>
        </div>
    </main>

    <?php include 'footer.php' ?>
</body>

</html>
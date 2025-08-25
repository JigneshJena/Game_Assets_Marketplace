<?php

require 'db.php';
session_start();
$message = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $select_user_data = $conn->prepare("Select id, username,password from users where username=? or email=?");
    $select_user_data->bind_param("ss", $username, $username);
    $select_user_data->execute();
    $result = $select_user_data->get_result();


    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location:dashboard.php");
            exit;
        } else {
            $message = "Invalid username or password.";
        }
    } else {
        $message = "Invalid usename or password.";
    }
    $select_user_data->close();
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
                <h2 class="text-center mb-2">Login</h2>
                <?php if ($message): ?>
                    <p class="text-center" style="color:red;"><?= htmlspecialchars($message) ?></p>
                <?php endif; ?>
                <form method="post" action="login.php">
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
                        <label for="password">password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            require>
                    </div>



                    <button type="submit" class="btn btn-primary btn-block">Login</button>

                </form>
                <div class="text-center mt-2">
                    <p>Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>

        </div>

    </main>




    <?php include 'footer.php' ?>
</body>

</html>
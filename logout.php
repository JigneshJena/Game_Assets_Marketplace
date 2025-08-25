<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Game Asset Marketplace</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php include 'header.php' ?>
    <main class="main-content">
        <div class="container text-center">
            <h2>You have been logged out.</h2>
            <p><a href="login.php">Click here to login again</a></p>
        </div>
    </main>

    <?php include 'footer.php' ?>
</body>

</html>
<?php 
session_start();
session_unset();
session_destroy();
header("Location:login.php");
exit;
?>
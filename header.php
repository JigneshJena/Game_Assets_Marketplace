<?php
// session_start();
?>
<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">🎮 Game Assets</div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="marketplace.php">Marketplace</a></li>
                   <?php if(isset($_SESSION['loggedin'])):  ?>
                    <li><a href="dashboard.php">dashboard</a></li>
                    <li><a href="asset_manager.php">Upload Asset</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                    <?php endif;?>
                </ul>
            </nav>
        </div>
    </div>
</header>
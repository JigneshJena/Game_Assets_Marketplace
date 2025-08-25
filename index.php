<?php
require 'db.php';

$assets = [];
$sql = "Select a.title,a.description,a.category,a.price,u.full_name as seller_name from assets a join users u on a.seller_id=u.id order by a.created_at desc limit 4";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $assets[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Asset Marketplace</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">🎮 Game Asset</div>
                <nav>
                    <ul class="nav-menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="marketplace.php">Marketplace</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header> -->
    <?php include 'header.php' ?>
    <main class="main-content">
        <div class="container">
            <h1 class="page-title">Welcome to the Game Asset Marketplace</h1>
            <p class="text-center mb-2">Buy , Sell , and trade digital assets for indie game developers</p>

            <h2 class="text-center mb-2">Latest assets</h2>
            <div class="products-grid">
                <?php if (count($assets) > 0): ?>
                    <?php foreach ($assets as $asset): ?>
                        <div class="product-card">
                            <div class="product-image">🎲</div>


                            <div class="product-info">
                                <h3 class="product-title">Sci-Fi Spaceship Model</h3>
                                <p class="product-description">A high-quality 3D model of a futuristic Spaceship..</p>
                                <div class="product-meta">
                                    <span class="product-price">$25.00</span>
                                    <span class="product-category">3D Models</span>
                                </div>
                                <div class="product-actions">
                                    <a href="marketplace.php" class="btn">View Details</a>
                                    <a href="purchase.php" class="btn btn-success">Buy now</a>
                                </div>
                                <small style="color:#6c757d;">By dev1</small>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <p class="text-center">NO assets found</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <!-- 
        <div class="product-card">
            <div class="product-image">
                🎶
            </div>
            <div class="product-info">
                <h3 class="product-title">Forest Ambience Sound</h3>
                <p class="product-description">A peaceful sound loop of a forest with birds and wind...</p>

                <div class="product-meta">
                    <span class="product-price">$9.00</span>
                    <span class="product-category">Sound Effects</span>
                </div>
                <div class="product-actions">
                    <a href="marketplace.php" class="btn">View Details</a>
                    <a href="purchase.php" class="btn btn-success">Buy Now</a>
                </div>
                <small styl="color: #6c757dd;">By dev2</small>
            </div>
        </div>

        <div class="product-card">
            <div class="product-image">
                🎨
            </div>
            <div class="product-info">
                <h3 class="product-title">Stone Texture Pack</h3>
                <p class="product-description">High-resolution stone textures for walls and floors...</p>
                <div class="product-meta">
                    <span class="product-price">$23.00</span>
                    <span class="product-category">Textures</span>
                </div>
                <div class="product-actions">
                    <a href="marketplace.php" class="btn">View Details</a>
                    <a href="purchase.php" class="btn btn-success">Buy Now</a>
                </div>
                <small style="color:#6c757d;">By dev1</small> -->

    <!-- </div>
        </div>

        <div class="product-card">
            <div class="product-image">
                🎲
            </div>
            <div class="product-info">
                <h3 class="product-title">Fantasy Swod Collection</h3>
                <p class="product-description">A set of 5 detailed fantasy swords for your RPG...</p>
                <div class="product-meta">
                    <span class="product-price">$52.00</span>
                    <span class="product-category">3D Models</span>
                </div>
                <div class="product-actions">
                    <a href="marketplace.php" class="btn">View Details</a>
                    <a href="purchase.php" class="btn btn-success">Buy Now</a>
                </div>
                <small class="color:#4c939a">By don</small>
            </div>

        </div> -->

    <?php include 'footer.php' ?>

</body>

</html>
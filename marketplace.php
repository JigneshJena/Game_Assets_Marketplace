<?php
require 'db.php';
$assets = [];
$sql = "select a.id,a.title,a.description,a.category,a.price,a.tags,u.full_name as seller_name from assets a join users u on a.seller_id=u.id order by a.created_at desc";
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
    <title>Marketplace - Game Asset Marketplace</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php include 'header.php' ?>
    <main class="main-content">
        <div class="container">
            <h1 class="page-title">Game Asset Marketplace</h1>
            <p class="text-center">Discover amazing digital assets for your next game project</p>
            <div class="filters">
                <form method="GET" class="filters-row">
                    <input type="text" name="search" placeholder="Search assets.." class="form-control">
                    <select name="category" class="form-control">
                        <option value="">All Categories</option>
                        <option value="3D Models">3D Models</option>
                        <option value="Sound Effects">Sound Effects</option>
                        <option value="Textures">Textures</option>
                        <option value="Animations">Animations</option>
                        <option value="Other">Other</option>
                    </select>

                    <select name="sort" class="form-control">
                        <option value="newest">Newest First</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="rating">Highest Rated</option>
                        <option value="downloads">Most downloads</option>
                    </select>
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>

            <div class="products-grid">
                <?php if (count($assets) > 0): ?>
                    <?php foreach ($assets as $asset): ?>
                        <div class="product-card">
                            <div class="product-image">🎲</div>
                            <div class="product-info">
                                <h3 class="product-title"><?= htmlspecialchars($asset['title']) ?></h3>
                                <p class="product-description"><?= htmlspecialchars($asset['description']) ?></p>
                                <div class="product-meta">
                                    <span class="product-price"><?= number_format($asset['price']) ?></span>
                                    <span class="product-category"><?= htmlspecialchars($asset['category']) ?></span>
                                </div>
                                <div class="product-actions">
                                    <a href="marketplace.php" class="btn">View Details</a>
                                    <a href="purchase.php" class="btn btn-success">Buy Now</a>

                                </div>
                                <small style="color:#6c757d;">By<?= htmlspecialchars($asset['seller_name']) ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">No Assets found</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <?php include 'footer.php' ?>
</body>

</html>
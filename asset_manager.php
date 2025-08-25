<?php
require 'db.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

$title = $descripton = $category = $price = $tags = '';
$message = '';
$asset_id = null;

// Handle asset editing
if (isset($_GET['id'])) {
    $asset_id = (int)$_GET['id'];
    $stmt = $conn->prepare("Select * from assets where id=? and seller_id=?");
    $stmt->bind_param("ii", $asset_id, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $asset = $result->fetch_assoc();
        $title = $asset['title'];
        $description = $asset['description'];
        $category = $asset['category'];
        $price = $asset['price'];
        $tags = $asset['tags'];
    } else {
        $message = "Asset not found or you don't have permission to edit it.";
        $asset_id = null;
    }
    $stmt->close();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $price = (float)$_POST['price'];
    $seller_id = $_SESSION['user_id'];
    $asset_id = isset($_POST['asset_id']) ? (int)$_POST['asset_id'] : null;
    if ($asset_id) {
        $stmt = $conn->prepare("update assets set title=?, description=?,category=?,price=?,tags=? where id=? and seller_id=?");
        $stmt->bind_param("sssdssi", $title, $description, $category, $price, $tags, $asset_id, $seller_id);
        if ($stmt->execute()) {
            $message = "Asset updated successfully";
        } else {
            $message = "Error updating asset: " . $stmt->error;
        }
    } else {
        $stmt = $conn->prepare("insert into assets(title,description,category,price, tags, seller_id)values(?,?,?,?,?,?)");
        $stmt->bind_param("sssdsi", $title, $description, $category, $price, $tags, $seller_id);
        if ($stmt->execute()) {
            $message = "Asset uploaded successfully";
        } else {
            $message = "Error uploading asset: " . $stmt->error;
        }
    }
    $stmt->close();
    $conn->close();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Asset - Game Asset Marketplace</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">🎮 Game Assets</div>
                <nav>
                    <ul class="nav-menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="marketplace.php">Marketplace</a></li>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="asset_manager.php">Upload Asset</a></li>
                        <li><a href="index.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header> -->

    <?php include 'header.php' ?>
    <main class="main-content">
        <div class="container">
            <div class="form-container">
                <h2 class="text-center mb-2"><?= $asset_id ? 'Edit Asset' : 'Upload asset' ?></h2>
                <?php if ($message): ?>
                    <p class="text-center" style="color:green;"><?= htmlspecialchars($message) ?></p>
                <?php endif; ?>
                <form>
                    <div class="form-group">
                        <label for="title">Asset Title *</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            class="form-control"
                            value="<?= htmlentities($title) ?>"
                            require>
                    </div>

                    <div class="form-group">
                        <label for="description">Description *</label>
                        <textarea id="description" name="description" rows="4" class="form-control " require></textarea>
                    </div>
                    <div class="form-group"></div>
                    <label for="category">Category *</label>
                    <select id="category" name="category" class="form-control" require>
                        <option value="">Select Category</option>
                        <option value="3D Models" <?= $category === '3D Models' ? 'selected' : '' ?>>3D Models</option>
                        <option value="Sound Effects" <?= $category === 'Sound Effects' ? 'selected' : '' ?>>Sound Effects</option>
                        <option value="Textures" <?= $category === 'Textures' ? 'selected' : '' ?>>Textures</option>
                        <option value="Animation" <?= $category === 'Animations' ? 'selected' : '' ?>>Animation</option>
                        <option value="Other" <?= $category === 'Other ' ? 'selected' : '' ?>>Other</option>
                    </select>

                    <div class="form-group">
                        <label for="price">Price ($) *</label>
                        <input
                            type="number"
                            id="price"
                            name="price"
                            step="0.01"
                            min="0"
                            class="form-control"
                            value="<?= htmlspecialchars($price) ?>"
                            require>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input
                            type="text"
                            id="tags"
                            name="tags"
                            class="form-control"
                            value="<?= htmlspecialchars($tags) ?>">
                        <small style="color:#6c757d;">Separate tags with commas</small>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"><?= $asset_id ? 'Update Asset' : 'Upload Assets' ?>Upload Asset</button>
                        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
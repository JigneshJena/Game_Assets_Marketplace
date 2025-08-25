<?php 
require 'db.php';


session_start();
if(!isset($_SESSION['loggedin'])){
    header("Location:login.php");
    exit;
}

$user_id =$_SESSION['user_id'];
$username =$_SESSION['username'];
// $username='';
$message='';


if(isset($_GET['delete_id'])){
    $delete_id=(int)$_GET['delete_id'];
    $stmt=$conn->prepare("Delete from assets where id=? and seller_id=?");
    $stmt->bind_param("ii", $delete_id,$user_id);
    if($stmt->execute()){
        $message="Asset deleted Successfully";
    }else{
        $message="Error deleting asset:".$stmt->error;
    }
    $stmt->close();
}

$user_info=null;
$user_assets=[];


// Fetch user info 

$stmt=$conn->prepare("Select full_name,email,bio from users where id=?");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$result=$stmt->get_result();
if($result->num_rows>0){
    $user_info=$result->fetch_assoc();
}
$stmt->close();


$stmt=$conn->prepare("Select id, title, description, category, price from assets where seller_id=? order by created_at desc");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$result=$stmt->get_result();
while($row=$result->fetch_assoc()){
    $user_assets[]=$row;
}
$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Game Asset Marketplace</title>
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
                    <li><a href="asset_manager.php">Upload asset</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </div>
  </header> -->

    <?php include 'header.php' ?>
  <main class="main-content">
    <div class="container">
        <h1 class="page-title">Dashboard</h1>
        <?php if($message):?>
            <p class="text-center" style="color:green;"><?=htmlspecialchars($message)?></p>
            <?php endif;?>
        <div class="form-container">
            <h2 >Welcome <?= htmlspecialchars($user_info['full_name'])?></h2>
            <p><strong>Username:</strong><?=htmlspecialchars($username)?></p>
            <p><strong>Email</strong><?=htmlspecialchars($user_info['email'])?></p>
            <p><strong>Bio:</strong><?=htmlspecialchars($user_info['bio'])?? 'N/A' ?></p>
        </div>

        <div style="margin-top:2rem;">
            <div class="flex justify-between aligh-cente" style="margin-bottom:1rem;">
                <h2>Your Assets (<?=count($user_assets)?>)</h2>
                <a href="asset_manager.php" class="btn">Upload New Asset</a>
            </div>

            <div class="product-grid">

            <?php if(count($user_assets)>0): ?>
                <?php foreach($user_assets as $asset): ?>
                <div  class="product-card">
                    <div class="product-image">🎲</div>
                    <div class="product-info">
                        <h3 class="product-title"><?= htmlspecialchars($asset['title'])?></h3>
                        <p class="product-description"><?= htmlspecialchars($asset['description'])?></p>
                        <div class="product-meta">
                            <span class="product-price">$<?= number_format($asset['price'],2)?></span>
                            <span class="product-category"><?=htmlspecialchars($asset['category'])?></span>
                        </div>

                        <div class="product-actions">
                            <a href="asset_manager.php?id<?= $asset['id']?>" class="btn btn-secondary">Edit</a>
                            <a href="dashboard.php?delete_id=<?= $asset['id']?>" class="btn btn-danger">Delete</a>
                        </div>
                        <small style="color:#6c757d;">Statu:Active</small>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">You have not uploaded any assets yet.</p>
                    <?php endif; ?>
                <!-- <div class="product-card">
                    <div class="product-image">🎲</div>
                    <div class="product-info">
                        <h3 class="product-title">Fantasy Swod Collection</h3>
                        <p class="product-description">A set of 5 detailed fantasy sword for your RPG...</p>
                        <div class="product-meta">
                            <span class="product-price">$15.00</span>
                            <span class="product-category">3D Models</span>
                        </div>
                        <div class="product-actions">
                            <a href="asset_manager.php" class="btn btn-secondary">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </div>
                        <small style="color:#6c757d;">Status:Active</small>
                    </div>

                </div> -->

            </div>

        </div>
    </div>
  </main> <?php include 'footer.php' ?>
</body>
</html>

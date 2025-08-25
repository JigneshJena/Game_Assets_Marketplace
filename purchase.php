<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">🎮 Game Assets</div>
                <nav>
                    <ul class="nav-menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="marketplace.php">Marketplace</a></li>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="index.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="form-container" style="max-width: 600px;">
                <h2 class="text-center mb-2">Purchase Asset</h2>

                <div style="background: #f8f0fa; padding:1.5rem;border-radius:10px;margin-bottom:2rem">
                    <h3>Asset Details</h3>
                    <p><strong>Asset:</strong>Sci-Fi Spacehip Model</p>
                    <p><strong>Seller:</strong>Jena Developer</p>
                    <p><strong>Category:</strong>3D Model</p>
                    <p style="font-size:1.5rem;font-weight:bold;color:#28a745;">Price:$25.00</p>
                </div>


                <form>
                    <div style="background: #e9ecef;padding:1rem;border-radius:5px;margin-bottom:1.5rem;">
                        <p style="margin: 0;color:#6c757d;">
                            <strong>Note:</strong>This is a demo purchase. In a real application,you would integrate with a payment processor.
                        </p>
                    </div>

                    <div style="display: flex;gap:1rem;">
                        <button type="submit" class="btn btn-success" style="flex:1;">Confirm Purchase - $25.00</button>
                        <a href="marketplace.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include 'footer.php' ?>
</body>

</html>
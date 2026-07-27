<?php
session_start();
include 'includes/db.php';

$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="header-container">
        <h1>Hey Cuties Welcome to Our Store</h1>

        <nav>
            <a href="pages/login.php">Login</a>
            <a href="pages/register.php">Register</a>

            <a href="pages/cart.php" class="cart-link">
                <img src="images/cart-icon.png" class="cart-icon" alt="Cart">
                Cart
            </a>

            <form method="POST" style="display:inline;">
                <button type="submit" name="logout" class="logout-button">
                    Logout
                </button>
            </form>
        </nav>
    </div>
</header>

<div class="main-container">

    <main>

        <h2>Products</h2>

        <div class="product-list">

            <?php
            if(count($products)>0)
            {
                foreach($products as $product)
                {
            ?>

            <div class="product">

                <img
                    src="/ecommerce/images/<?php echo htmlspecialchars($product['image']); ?>"
                    alt="<?php echo htmlspecialchars($product['name']); ?>"
                    class="product-image">

                <h3>
                    <?php echo htmlspecialchars($product['name']); ?>
                </h3>

                <p>
                    Price: $<?php echo number_format($product['price'],2); ?>
                </p>

                <p>
                    <?php echo htmlspecialchars($product['description']); ?>
                </p>

                <form action="pages/cart.php" method="POST">

                    <input
                        type="hidden"
                        name="product_id"
                        value="<?php echo $product['id']; ?>">

                    <button
                        type="submit"
                        name="add_to_cart"
                        class="add-to-cart-button">

                        Add to Cart

                    </button>

                </form>

            </div>

            <?php
                }
            }
            else
            {
                echo "<h2>No Products Available</h2>";
            }
            ?>

        </div>

    </main>

</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Online Store. All rights reserved.</p>
</footer>

</body>
</html>
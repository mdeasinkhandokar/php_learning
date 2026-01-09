<?php
session_start();

/* Cart item count */
$count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $count += $item['quantity'];
    }
}

/* Product list */
$products = [
    1 => ["name" => "Laptop", "price" => 800],
    2 => ["name" => "Smartphone", "price" => 500],
    3 => ["name" => "Headphones", "price" => 80],
    4 => ["name" => "Keyboard", "price" => 40],
    5 => ["name" => "Mouse", "price" => 25],
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>

<h2>Electronics Store</h2>
<p>🛒 Cart Items: <b><?php echo $count; ?></b> |
<a href="cart.php">View Cart</a></p>

<hr>

<?php foreach ($products as $id => $product): ?>
    <div style="margin-bottom:15px;">
        <img src="https://via.placeholder.com/100"><br>
        <b><?php echo $product['name']; ?></b><br>
        Price: $<?php echo $product['price']; ?><br>

        <form method="post" action="add_to_cart.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="name" value="<?php echo $product['name']; ?>">
            <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
<?php endforeach; ?>

</body>
</html>

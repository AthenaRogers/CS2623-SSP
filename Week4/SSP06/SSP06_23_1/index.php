<?php
declare(strict_types=1);

require '../SSP06_21_2/auth.php';

// product
$products = [
    1 => ['id' => 1, 'name' => 'Fender Stratocaster', 'price' => 499.99],
    2 => ['id' => 2, 'name' => 'Gibson Les Paul', 'price' => 799.99],
    3 => ['id' => 3, 'name' => 'Martin D-28 Acoustic', 'price' => 1299.99],
    4 => ['id' => 4, 'name' => 'Ibanez RG550', 'price' => 299.99],
];

$_SESSION['cart'] ??= [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';

    if ($id !== null && $id !== false && isset($products[$id])) {

        if ($action === 'add') {

            $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;

        } elseif ($action === 'remove') {

            if (isset($_SESSION['cart'][$id])) {

                $_SESSION['cart'][$id]--;

                if ($_SESSION['cart'][$id] <= 0) {
                    unset($_SESSION['cart'][$id]);
                }
            }
        }
    }

    header('Location: index.php');
    exit;
}

// calculate
$total = 0.0;
$itemCount = 0;

foreach ($_SESSION['cart'] as $pid => $qty) {

    if (isset($products[$pid])) {

        $total += $products[$pid]['price'] * $qty;
        $itemCount += $qty;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS2623 Server-Side Programming - Product Catalog</title>

    <style>
        body {
            font-family: Calibri, Tahoma, Verdana, sans-serif;
            background-color: #F5F5F5;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #1B2A6B;
            color: white;
            text-align: center;
            padding: 20px;
        }

        h1, h2, h3 {
            font-family: "Times New Roman", serif;
        }

        #top-nav {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            padding: 15px;
        }

        #top-nav a {
            background-color: #006B7D;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
        }

        #top-nav a:hover {
            background-color: #004C5A;
        }

        main {
            background-color: white;
            max-width: 900px;
            margin: 20px auto;
            padding: 25px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .product {
            border: 1px solid #CCCCCC;
            padding: 15px;
            border-radius: 4px;
        }

        .product h3 {
            margin-top: 0;
        }

        button {
            background-color: #006B7D;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #004C5A;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #CCCCCC;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #1B2A6B;
            color: white;
        }

        .cart-total {
            font-weight: bold;
        }

        .cart-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        .action-link {
            display: inline-block;
            background-color: #006B7D;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 4px;
        }

        .action-link:hover {
            background-color: #004C5A;
        }

        footer {
            background-color: #E0E0E0;
            text-align: center;
            padding: 15px;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <header>
        <h1>CS2623 Server-Side Programming</h1>
        <p>Week 4: Product Catalog and Shopping Cart (SSP06)</p>
    </header>

    <nav id="top-nav">
        <a href="../SSP06_21_2/dashboard.php">Back to Dashboard</a>
        <a href="../SSP06_21_2/profile.php">View Profile</a>
        <a href="../SSP06_21_2/logout.php">Log out</a>
    </nav>

    <main>
        <h2>Product Catalog</h2>

        <p>Welcome, <?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8') ?>!</p>

        <h2>Your Cart (<?= $itemCount ?> items)</h2>

        <h2>Available Products</h2>

        <div class="product-grid">

            <?php foreach ($products as $p): ?>

                <div class="product">

                    <h3><?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?></h3>

                    <p>Price: $<?= number_format($p['price'], 2) ?></p>

                    <form method="post">

                        <input type="hidden" name="product_id"
                        value="<?= (int) $p['id'] ?>">

                        <input type="hidden" name="action" value="add">

                        <button type="submit">Add to Cart</button>

                    </form>

                </div>

            <?php endforeach; ?>

        </div>

        <h2>Your Shopping Cart</h2>

        <?php if (empty($_SESSION['cart'])): ?>

            <p>Your cart is empty.</p>

        <?php else: ?>

            <table>

                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($_SESSION['cart'] as $pid => $qty): ?>

                    <?php if (isset($products[$pid])): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($products[$pid]['name'], ENT_QUOTES, 'UTF-8') ?>
                            </td>

                            <td>
                                <?= (int) $qty ?>
                            </td>

                            <td>
                                $<?= number_format($products[$pid]['price'] * $qty, 2) ?>
                            </td>

                            <td>

                                <form method="post">

                                    <input type="hidden" name="product_id"
                                    value="<?= (int) $pid ?>">

                                    <input type="hidden" name="action" value="remove">

                                    <button type="submit">Remove One</button>

                                </form>

                            </td>

                        </tr>

                    <?php endif; ?>

                <?php endforeach; ?>

                <tr>
                    <td colspan="2" class="cart-total">Total</td>

                    <td colspan="2" class="cart-total">
                        $<?= number_format($total, 2) ?>
                    </td>
                </tr>

            </table>

        <?php endif; ?>

        <div class="cart-actions">
            <a class="action-link" href="cart_clear.php">Clear Cart</a>
            <a class="action-link" href="../SSP06_21_2/dashboard.php">Back to Dashboard</a>
        </div>

    </main>

    <footer>
        <p>CS2623 Server-Side Programming | Week 4 | SSP06</p>
    </footer>

</body>
</html>
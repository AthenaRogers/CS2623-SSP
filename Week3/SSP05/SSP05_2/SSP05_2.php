<?php
declare(strict_types=1);

$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD') ?? 'GET';
$cust_name = '';
$product = '';
$quantity = 1;
$payment = 'none';
$instructions = '';
$options = [];
$quantity_valid = true;

if ($method === 'POST') {
    $cust_name = filter_input(INPUT_POST, 'cust_name') ?? '';
    $product = filter_input(INPUT_POST, 'product') ?? '';

    $quantity_result = filter_input(
        INPUT_POST,
        'quantity',
        FILTER_VALIDATE_INT,
        ['options' => ['min_range' => 1]]
    );

    $quantity_valid = $quantity_result !== false
        && $quantity_result !== null;

    $quantity = $quantity_valid ? $quantity_result : 1;

    $payment = filter_input(INPUT_POST, 'payment') ?? 'none';
    $instructions = filter_input(INPUT_POST, 'instructions') ?? '';

    $options = filter_input(
        INPUT_POST,
        'options',
        FILTER_SANITIZE_SPECIAL_CHARS,
        FILTER_REQUIRE_ARRAY
    ) ?? [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 7-2: Product Order Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 700px;
            margin: 30px auto;
            padding: 20px;
            line-height: 1.5;
        }

        form, .order-summary {
            border: 1px solid #cccccc;
            padding: 20px;
            margin-bottom: 20px;
        }

        label {
            display: inline-block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="number"], select, textarea {
            display: block;
            width: 100%;
            max-width: 400px;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        button {
            padding: 8px 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Product Order Form</h1>

    <form method="post" action="">
        <p>
            <label for="cust_name">Customer Name:</label>
            <input type="text" id="cust_name" name="cust_name" required>
        </p>

        <p>
            <label for="product">Product:</label>
            <select id="product" name="product" required>
                <option value="Laptop - $799.99">Laptop - $799.99</option>
                <option value="Keyboard - $49.99">Keyboard - $49.99</option>
                <option value="Mouse - $24.99">Mouse - $24.99</option>
                <option value="Monitor - $199.99">Monitor - $199.99</option>
            </select>
        </p>

        <p>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity"
                   min="1" required>
        </p>

        <p>Options/Add-ons:</p>
        <input type="checkbox" id="gift_wrap" name="options[]"
               value="Gift Wrap">
        <label for="gift_wrap">Gift Wrap</label><br>

        <input type="checkbox" id="express_ship" name="options[]"
               value="Express Shipping">
        <label for="express_ship">Express Shipping</label><br>

        <input type="checkbox" id="insurance" name="options[]"
               value="Insurance">
        <label for="insurance">Insurance</label>

        <p>
            <label for="instructions">Special Instructions:</label>
            <textarea id="instructions" name="instructions"
                      rows="5" cols="40"></textarea>
        </p>

        <p>Payment Method:</p>
        <input type="radio" id="credit" name="payment" value="credit" required>
        <label for="credit">Credit</label>

        <input type="radio" id="debit" name="payment" value="debit">
        <label for="debit">Debit</label>

        <input type="radio" id="paypal" name="payment" value="paypal">
        <label for="paypal">PayPal</label>

        <p><button type="submit">Submit Order</button></p>
    </form>

    <?php if ($method === 'POST'): ?>
        <div class="order-summary">
            <h2>Order Summary</h2>

            <p><strong>Customer:</strong>
                <?= htmlspecialchars($cust_name, ENT_QUOTES, 'UTF-8') ?>
            </p>

            <p><strong>Product:</strong>
                <?= htmlspecialchars($product, ENT_QUOTES, 'UTF-8') ?>
            </p>

            <p><strong>Quantity:</strong>
                <?= htmlspecialchars((string) $quantity, ENT_QUOTES, 'UTF-8') ?>
                <?= !$quantity_valid ? '(invalid quantity; enter an integer of at least 1)' : '' ?>
            </p>

            <p><strong>Payment:</strong>
                <?= htmlspecialchars($payment, ENT_QUOTES, 'UTF-8') ?>
            </p>

            <p><strong>Selected Options:</strong></p>
            <ul>
                <?php foreach ($options as $opt): ?>
                    <li><?= htmlspecialchars($opt, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>

            <p><strong>Instructions:</strong><br>
                <?= nl2br(htmlspecialchars($instructions, ENT_QUOTES, 'UTF-8')) ?>
            </p>
        </div>
    <?php endif; ?>

    <p><a href="../index.html">Back to Week 3 Hub</a></p>
</body>
</html>
```
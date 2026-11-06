<?php
declare(strict_types=1);

class ValidationException extends RuntimeException
{
}

class DatabaseException extends RuntimeException
{
}

class FormatException extends ValidationException
{
}
function validateContact(array $data): array
{

    $errors = [];

    if (!filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    }
    if (!filter_var($data['website'] ?? '', FILTER_VALIDATE_URL)) {
        $errors[] = 'Invalid website URL.';
    }
    if (filter_var($data['quantity'] ?? '', FILTER_VALIDATE_INT) === false) {
        $errors[] = 'Quantity must be a valid integer.';
    }
    $phone = $data['phone'] ?? '';
    if (!preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone)) {
        $errors[] = 'Phone must be in format 555-555-5555.';
    }
    $zip = $data['zip'] ?? '';
    if (!preg_match('/^\d{5}(-\d{4})?$/', $zip)) {
        $errors[] = 'ZIP must be 5 digits or ZIP+4 (e.g. 74103 or 74103-1234).';
    }
    if ($errors) {
        throw new ValidationException(implode(' | ', $errors));
    }
    $productCode = $data['product_code'] ?? '';

    if (!preg_match('/^[A-Z]{2}\d{4}$/', $productCode)) {
        throw new FormatException(
            'Product code must contain two uppercase letters followed by four digits.'
        );
    }

    return $data;
}

$result = null;
$errMsg = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $raw = [

        'email' => filter_input(
            INPUT_POST,
            'email',
            FILTER_SANITIZE_SPECIAL_CHARS
        ) ?? '',

        'website' => filter_input(
            INPUT_POST,
            'website',
            FILTER_SANITIZE_SPECIAL_CHARS
        ) ?? '',

        'quantity' => filter_input(
            INPUT_POST,
            'quantity',
            FILTER_SANITIZE_SPECIAL_CHARS
        ) ?? '',

        'phone' => filter_input(
            INPUT_POST,
            'phone',
            FILTER_SANITIZE_SPECIAL_CHARS
        ) ?? '',

        'zip' => filter_input(
            INPUT_POST,
            'zip',
            FILTER_SANITIZE_SPECIAL_CHARS
        ) ?? '',

        'product_code' => filter_input(
            INPUT_POST,
            'product_code',
            FILTER_SANITIZE_SPECIAL_CHARS
        ) ?? '',

        'notes' => filter_input(
            INPUT_POST,
            'notes',
            FILTER_SANITIZE_SPECIAL_CHARS
        ) ?? '',

        'message' => filter_input(
            INPUT_POST,
            'message',
            FILTER_SANITIZE_SPECIAL_CHARS
        ) ?? '',
    ];

    try {

        $result = validateContact($raw);

    } catch (FormatException $e) {

        $errMsg = $e->getMessage();

    } catch (ValidationException $e) {

        $errMsg = $e->getMessage();

    } catch (RuntimeException $e) {

        $errMsg = 'System error: ' . $e->getMessage();

    } finally {

        error_log('Contact form processed at ' . date('Y-m-d H:i:s'));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ex 15-1 Validation</title>
</head>
<body>

<h1>Contact Form Validation</h1>

<?php if ($errMsg): ?>

    <div class="error">

        <?= htmlspecialchars($errMsg, ENT_QUOTES, 'UTF-8') ?>

    </div>

<?php endif; ?>

<?php if ($result): ?>

    <p>All fields valid - ready to save.</p>

    <ul>

        <li>
            Email:
            <?= htmlspecialchars($result['email'], ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            Website:
            <?= htmlspecialchars($result['website'], ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            Quantity:
            <?= htmlspecialchars($result['quantity'], ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            Phone:
            <?= htmlspecialchars($result['phone'], ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            ZIP:
            <?= htmlspecialchars($result['zip'], ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            Product Code:
            <?= htmlspecialchars($result['product_code'], ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            Notes:
            <?= htmlspecialchars($result['notes'], ENT_QUOTES, 'UTF-8') ?>
        </li>

    </ul>

    <h2>Message</h2>

    <p>
        <?= nl2br(htmlspecialchars($result['message'], ENT_QUOTES, 'UTF-8')) ?>
    </p>

<?php endif; ?>

<form method="post">

    <label>Email:
        <input type="text" name="email">
    </label>
    <br>

    <label>Website:
        <input type="text" name="website">
    </label>
    <br>

    <label>Quantity:
        <input type="text" name="quantity">
    </label>
    <br>

    <label>Phone (555-555-5555):
        <input type="text" name="phone">
    </label>
    <br>

    <label>ZIP:
        <input type="text" name="zip">
    </label>
    <br>

    <label>Product Code (AB1234):
        <input type="text" name="product_code">
    </label>
    <br>

    <label>Notes:
        <br>
        <textarea name="notes" rows="4" cols="40"></textarea>
    </label>
    <br>

    <label>Message:
        <br>
        <textarea name="message" rows="4" cols="40"></textarea>
    </label>
    <br>

    <button type="submit">Validate</button>

</form>

</body>
</html>
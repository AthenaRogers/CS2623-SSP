<?php
declare(strict_types=1);

$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD') ?? 'GET';
$first = '';
$last = '';
$email = '';
$age = 0;
$gender = 'not specified';
$country = '';
$comments = '';
$email_valid = true;
$age_valid = true;

if ($method === 'POST') {
    $first = filter_input(INPUT_POST, 'first_name') ?? '';
    $last = filter_input(INPUT_POST, 'last_name') ?? '';

    $email_input = filter_input(INPUT_POST, 'email') ?? '';
    $email_result = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    $email_valid = $email_result !== false && $email_result !== null;
    $email = $email_valid ? $email_result : $email_input;

    $age_input = filter_input(INPUT_POST, 'age') ?? '';
    $age_result = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);

    $age_valid = $age_result !== false && $age_result !== null;
    $age = $age_valid ? $age_result : $age_input;

    $gender = filter_input(INPUT_POST, 'gender') ?? 'not specified';
    $country = filter_input(INPUT_POST, 'country') ?? '';
    $comments = filter_input(INPUT_POST, 'comments') ?? '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 7-1: Personal Info Form</title>
</head>
<body>
    <h1>Personal Information Form</h1>

    <form method="post" action="">
        <p>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
        </p>

        <p>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
        </p>

        <p>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </p>

        <p>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" min="0" required>
        </p>

        <p>Gender:</p>
        <input type="radio" id="male" name="gender" value="male">
        <label for="male">Male</label>

        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Female</label>

        <input type="radio" id="other" name="gender" value="other">
        <label for="other">Other</label>

        <p>
            <label for="country">Country:</label>
            <select id="country" name="country">
                <option value="United States">United States</option>
                <option value="Canada">Canada</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="Australia">Australia</option>
                <option value="India">India</option>
            </select>
        </p>

        <p>
            <label for="comments">Comments:</label><br>
            <textarea id="comments" name="comments" rows="5" cols="40"></textarea>
        </p>

        <button type="submit">Submit</button>
    </form>

    <?php if ($method === 'POST'): ?>
        <h2>Submitted Information</h2>

        <p><strong>Name:</strong>
            <?= htmlspecialchars($first . ' ' . $last, ENT_QUOTES, 'UTF-8') ?>
        </p>

        <p><strong>Email:</strong>
            <?= htmlspecialchars($email_valid ? $email : '(invalid)', ENT_QUOTES, 'UTF-8') ?>
        </p>

        <p><strong>Age:</strong>
            <?= htmlspecialchars((string) $age, ENT_QUOTES, 'UTF-8') ?>
            <?= !$age_valid ? '(invalid integer)' : '' ?>
        </p>

        <p><strong>Gender:</strong>
            <?= htmlspecialchars($gender, ENT_QUOTES, 'UTF-8') ?>
        </p>

        <p><strong>Country:</strong>
            <?= htmlspecialchars($country, ENT_QUOTES, 'UTF-8') ?>
        </p>

        <p><strong>Comments:</strong><br>
            <?= nl2br(htmlspecialchars($comments, ENT_QUOTES, 'UTF-8')) ?>
        </p>
    <?php endif; ?>

    <p><a href="../index.html">Back to Week 3 Hub</a></p>
</body>
</html>
```
<?php
declare(strict_types=1);

session_start();

$users = [
    'admin' => password_hash('secret123', PASSWORD_DEFAULT),
    'jsmith' => password_hash('php4life!', PASSWORD_DEFAULT),
];

$error = '';

$rememberedUser = filter_input(
    INPUT_COOKIE,
    'remember_username',
    FILTER_SANITIZE_SPECIAL_CHARS
) ?? '';

if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = filter_input(
        INPUT_POST,
        'username',
        FILTER_SANITIZE_SPECIAL_CHARS
    ) ?? '';

    $password = filter_input(
        INPUT_POST,
        'password',
        FILTER_DEFAULT
    ) ?? '';

    $remember = isset($_POST['remember']);

    if ($_SESSION['attempts'] >= 3) {

        $error = 'Account locked after 3 failed login attempts.';

    } elseif (
        isset($users[$username]) &&
        password_verify($password, $users[$username])
    ) {

        session_regenerate_id(true);

        $_SESSION['user'] = $username;
        $_SESSION['login_at'] = time();

        if ($remember) {
            setcookie(
                'remember_username',
                $username,
                time() + (30 * 24 * 60 * 60),
                '/'
            );
        } else {
            setcookie(
                'remember_username',
                '',
                time() - 3600,
                '/'
            );
        }

        unset($_SESSION['attempts']);

        header('Location: dashboard.php');
        exit;

    } else {

        $_SESSION['attempts']++;

        $error = 'Invalid username or password.';

        if ($_SESSION['attempts'] >= 3) {
            $error = 'Account locked after 3 failed login attempts.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS2623 Server-Side Programming - Login</title>

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

        h1, h2 {
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

        form {
            max-width: 400px;
        }

        label {
            display: block;
            margin: 15px 0;
        }

        input[type="text"],
        input[type="password"] {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            margin-top: 5px;
        }

        button {
            background-color: #006B7D;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #004C5A;
        }

        .error {
            color: #B00020;
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
        <p>Week 4: Login and Authentication (SSP06)</p>
    </header>

    <nav id="top-nav">
        <a href="../index.html">Back to SSP06 Hub</a>
    </nav>

    <main>
        <h2>Login</h2>
        <p>Enter your username and password to access your account.</p>

        <?php if ($error): ?>
            <p class="error">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>

        <form method="post">

            <label>Username:
                <input type="text" name="username"
                value="<?= htmlspecialchars($rememberedUser, ENT_QUOTES, 'UTF-8') ?>"
                autocomplete="username">
            </label>

            <label>Password:
                <input type="password" name="password"
                autocomplete="current-password">
            </label>

            <label>
                <input type="checkbox" name="remember">
                Remember me
            </label>

            <button type="submit">Log in</button>

        </form>
    </main>

    <footer>
        <p>CS2623 Server-Side Programming | Week 4 | SSP06</p>
    </footer>

</body>
</html>
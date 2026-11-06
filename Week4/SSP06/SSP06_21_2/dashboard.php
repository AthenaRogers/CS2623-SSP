<?php
declare(strict_types=1);

require 'auth.php';

$loginTime = new DateTime('@' . $_SESSION['login_at']);
$loginTime->setTimezone(new DateTimeZone('America/Chicago'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS2623 Server-Side Programming - Dashboard</title>

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
        <a href="profile.php">View Profile</a>
        <a href="../SSP06_23_1/index.php">Product Catalog</a>
        <a href="logout.php">Log out</a>
    </nav>

    <main>
        <h2>Dashboard</h2>

        <p>Welcome, <?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8') ?>!</p>

        <p>Logged in at: <?= $loginTime->format('g:i A') ?></p>

        <h2>Account Options</h2>

        <ul>
            <li>
                <a href="profile.php">View Profile</a>
                <p>View your account username.</p>
            </li>

            <li>
                <a href="../SSP06_23_1/index.php">Product Catalog and Shopping Cart</a>
                <p>Browse products and manage your shopping cart.</p>
            </li>

            <li>
                <a href="logout.php">Log out</a>
                <p>End your current session.</p>
            </li>
        </ul>
    </main>

    <footer>
        <p>CS2623 Server-Side Programming | Week 4 | SSP06</p>
    </footer>

</body>
</html>
<?php

declare(strict_types=1);

$description = 'PHP is a useful language for web development and online stores.';
$replaced = str_replace('useful', 'powerful', $description);
$contains_php = str_contains($description, 'PHP') ? 'true' : 'false';
$lowercase = strtolower($description);
$uppercase = strtoupper($description);
$character_count = (string) strlen($description);
$price = sprintf('$%.2f', 9.9);
$large_number = number_format(1000000);
$substring = substr('Hello', 0, 3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Rogers, Athena">
    <meta name="description" content="CS2623 SSP04 String Functions">
    <title>CS2623 SSP04: String Functions</title>
    <link rel="stylesheet" href="../SSP01/main.css">
</head>
<body>
    <header>
        <h1>CS2623 Server-Side Programming</h1>
    </header>

    <nav id="top-nav">
        <a href="../SSP01/index.php">Home</a>
        <a href="../SSP02/SSP02.php">SSP02</a>
        <a href="../SSP03/SSP03.php">SSP03</a>
        <a href="../SSP03/SSP04.php">SSP04</a>
        <a href="../SSP05/SSP05.php">SSP05</a>
        <a href="../SSP06/SSP06.php">SSP06</a>
        <a href="../SSP07/SSP07.php">SSP07</a>
        <a href="../SSP08/SSP08.php">SSP08</a>
        <a href="../SSP09/SSP09.php">SSP09</a>
        <a href="../SSP10/SSP10.php">SSP10</a>
        <a href="../SSP11/SSP11.php">SSP11</a>
        <a href="../SSP12/SSP12.php">SSP12</a>
    </nav>

    <main>
        <h2>Exercise 1: String Functions</h2>

        <p>Original description:
            <?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>
        </p>

        <table border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th>Function</th>
                    <th>Input</th>
                    <th>Output</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars('str_replace()', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($replaced, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td><?php echo htmlspecialchars('str_contains()', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars('PHP', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($contains_php, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td><?php echo htmlspecialchars('strtolower()', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($lowercase, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td><?php echo htmlspecialchars('strtoupper()', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($uppercase, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td><?php echo htmlspecialchars('strlen()', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($character_count, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td><?php echo htmlspecialchars('sprintf()', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars('9.9', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($price, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td><?php echo htmlspecialchars('number_format()', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars('1000000', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($large_number, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td><?php echo htmlspecialchars('substr()', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars('Hello', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($substring, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
            </tbody>
        </table>

        <p><a href="ex2_datetime.php">Exercise 2: Date and Time</a></p>
    </main>

    <footer>
        <p>Disclaimer: Oklahoma City Community College does not necessarily endorse the content or the respective links of this web page.</p>
    </footer>
</body>
</html>
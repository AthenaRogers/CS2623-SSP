<?php

declare(strict_types=1);

$tz = new DateTimeZone('America/Chicago');
$now = new DateTime('now', $tz);

$today_name = $now->format('l');
$today_date = $now->format('F j, Y');
$today_time = $now->format('g:i:s A');

$birth_str = '1997-09-22';
$birth_date = DateTime::createFromFormat('!Y-m-d', $birth_str, $tz);

if ($birth_date === false) {
    exit('The birthdate could not be parsed.');
}

$age_interval = $birth_date->diff($now);
$age_years = (string) $age_interval->y;
$age_days = (string) $age_interval->days;

// Countdown
$end_date = new DateTime('2026-12-15', $tz);
$interval = $now->diff($end_date);
$days_left = (string) $interval->days;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Rogers, Athena">
    <meta name="description" content="CS2623 SSP04 Date and Time">
    <title>CS2623 SSP04: Date and Time</title>
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
        <h2>Exercise 2: Date and Time</h2>

        <p>Today is:
            <?php

            echo htmlspecialchars(
                $today_name . ', ' . $today_date,
                ENT_QUOTES,
                'UTF-8'
            );
            ?>
        </p>

        <p>Current time (Central Time):
            <?php echo htmlspecialchars($today_time, ENT_QUOTES, 'UTF-8'); ?>
        </p>

        <p>Birthdate:
            <?php echo htmlspecialchars($birth_date->format('F j, Y'), ENT_QUOTES, 'UTF-8'); ?>
        </p>

        <p>Age in years:
            <?php echo htmlspecialchars($age_years, ENT_QUOTES, 'UTF-8'); ?>
        </p>

        <p>Elapsed days since birth:
            <?php echo htmlspecialchars($age_days, ENT_QUOTES, 'UTF-8'); ?>
        </p>

        <p>Semester end date:
            <?php echo htmlspecialchars($end_date->format('F j, Y'), ENT_QUOTES, 'UTF-8'); ?>
        </p>

        <p>Days until semester end:
            <?php echo htmlspecialchars($days_left, ENT_QUOTES, 'UTF-8'); ?>
            days
        </p>

        <p><a href="ex1_strings.php">Exercise 1: String Functions</a></p>
    </main>

    <footer>
        <p>Disclaimer: Oklahoma City Community College does not necessarily endorse the content or the respective links of this web page.</p>
    </footer>
</body>
</html>
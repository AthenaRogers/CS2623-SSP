<?php

declare(strict_types=1);

require_once __DIR__ . '/PHP/functions_ssp03.php';
require_once __DIR__ . '/PHP/include_header.php';

// Timezone
$tz = new DateTimeZone('America/Chicago');
$now = new DateTime('now', $tz);
$current_day = (int) $now->format('N');

echo '<h2>CS-2623 Weekly Study Planner</h2>';
echo '<p>Today is: ' .
    htmlspecialchars($now->format('l, F j, Y'), ENT_QUOTES, 'UTF-8') .
    '</p>';

fn_tableOpen('CS-2623 Weekly Study Planner');

for ($day = 1; $day <= 7; $day++) {
    $name = fn_dayOfWeek($day);
    $details = fn_dayDetails($day);
    $time = fn_dayTime($day);

    if ($day === $current_day) {
        fn_tableRowCurrent($name, $details, $time);
    } else {
        fn_tableRow($name, $details, $time);
    }
}

fn_tableClose();

require_once __DIR__ . '/PHP/include_footer.php';
?>
<?php

declare(strict_types=1);

/**
 * Opens the weekly planner table and outputs its headings.
 *
 * @param string $caption The table caption.
 * @return void
 */
function fn_tableOpen(string $caption): void
{
    echo '<table border="1" cellpadding="6" cellspacing="0">';
    echo '<tr style="background-color:#1B2A6B;color:#FFFFFF;">';
    echo '<th colspan="3">';
    echo htmlspecialchars($caption, ENT_QUOTES, 'UTF-8');
    echo '</th>';
    echo '</tr>';
    echo '<tr style="background-color:#006B7D;color:#FFFFFF;">';
    echo '<th>Day</th><th>Details</th><th>Time</th>';
    echo '</tr>';
}

/**
 * Closes the weekly planner table.
 *
 * @return void
 */
function fn_tableClose(): void
{
    echo '</table>';
}

/**
 * Outputs the current day's schedule row with a yellow background.
 *
 * @param string $day The day name.
 * @param string $details The scheduled activity.
 * @param string $time The scheduled time.
 * @return void
 */
function fn_tableRowCurrent(
    string $day,
    string $details,
    string $time
): void {
    echo '<tr style="background-color:#FFFF66;">';
    echo '<td>' . htmlspecialchars($day, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($details, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($time, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '</tr>';
}

/**
 * Outputs a normal schedule row.
 *
 * @param string $day The day name.
 * @param string $details The scheduled activity.
 * @param string $time The scheduled time.
 * @return void
 */
function fn_tableRow(
    string $day,
    string $details,
    string $time
): void {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($day, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($details, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($time, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '</tr>';
}

/**
 * Returns the day name for a number from 1 through 7.
 *
 * @param int $day_num The day number, with Monday as 1.
 * @return string The day name or Unknown.
 */
function fn_dayOfWeek(int $day_num): string
{
    if ($day_num === 1) {
        return 'Monday';
    } elseif ($day_num === 2) {
        return 'Tuesday';
    } elseif ($day_num === 3) {
        return 'Wednesday';
    } elseif ($day_num === 4) {
        return 'Thursday';
    } elseif ($day_num === 5) {
        return 'Friday';
    } elseif ($day_num === 6) {
        return 'Saturday';
    } elseif ($day_num === 7) {
        return 'Sunday';
    } else {
        return 'Unknown';
    }
}

/**
 * Returns the scheduled activity for a day number.
 *
 * @param int $day_num The day number, with Monday as 1.
 * @return string The activity or No schedule.
 */
function fn_dayDetails(int $day_num): string
{
    switch ($day_num) {
        case 1:
            return 'PHP lecture — Ch08 Conditionals';
        case 2:
            return 'Lab: SSP03 function library';
        case 3:
            return 'Study: string functions Ch09';
        case 4:
            return 'Lab: SSP04 exercises';
        case 5:
            return 'Quiz review + office hours';
        case 6:
            return 'Project work';
        case 7:
            return 'Rest day';
        default:
            return 'No schedule';
    }
}

/**
 * Returns the scheduled time for a day number.
 *
 * @param int $day_num The day number, with Monday as 1.
 * @return string The scheduled time or TBD.
 */
function fn_dayTime(int $day_num): string
{
    if ($day_num === 1 || $day_num === 3) {
        return '9:00 AM – 10:20 AM';
    } elseif ($day_num === 2 || $day_num === 4) {
        return '1:00 PM – 2:50 PM';
    } elseif ($day_num === 5) {
        return '10:00 AM – 11:00 AM';
    } elseif ($day_num === 6 || $day_num === 7) {
        return 'Flexible';
    } else {
        return 'TBD';
    }
}
<?php
declare(strict_types=1);

require '../SSP06_21_2/auth.php';

unset($_SESSION['cart']);

header('Location: index.php');
exit;
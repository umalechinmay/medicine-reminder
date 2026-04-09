<?php
$medicine = $_POST['medicine'];
$time = $_POST['time'];

$data = $medicine . " - " . $time . "\n";

file_put_contents("data.txt", $data, FILE_APPEND);

header("Location: dashboard.php");
?>
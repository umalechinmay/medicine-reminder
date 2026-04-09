<?php
$id = $_GET['id'];

$file = file("data.txt");
unset($file[$id]);

file_put_contents("data.txt", implode("", $file));

header("Location: dashboard.php");
?>
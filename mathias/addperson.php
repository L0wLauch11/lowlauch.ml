<?php
$name = $_GET['name'];

$dir = 'mpunkte';
$filename = '0.txt';

$index = 0;
while (file_exists("$dir/$filename")) {
    $index++;
    $filename = "$index.txt";
}

$new_file = fopen("$dir/$filename", "w") or die("Unable to open file!");
fwrite($new_file, "$name\n0");

header('location: mpunkte.php');

?>
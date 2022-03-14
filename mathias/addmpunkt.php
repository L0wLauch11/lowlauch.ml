<?php
$dir = 'mpunkte';

$filename = $_GET['file'];
$value = $_GET['value'];

// Read file and set m punkte
$file = new SplFileObject("$dir/$filename");

$entry = array();
while (!$file->eof()) {
    $entry[] = $file->fgets();
}
$new_value = $entry[1] + $value;

$file = null;

// Write changes to file
file_put_contents("$dir/$filename", "${entry[0]}$new_value");

?>